if (localStorage.getItem('tokenNeraca') != null) {
    $('#form-report').show()
    $('#form-password').hide()
} else {
    $('#form-report').hide()
    $('#form-password').show()
}

$('#verify').submit(function(e) {
    e.preventDefault()
    $('#submit').attr('disabled', true)
    $('#text').hide()
    $('#loading').show()
    let password = $('#password').val()
    $.ajax({
        url: api_url + 'verifyPassword',
        type: 'POST',
        dataType: 'JSON',
        headers: {
            'token-id': token
        },
        data: {
            password: password
        },
        success: function(result) {
            if (result.status == true) {
                $('#form-report').show()
                $('#form-password').hide()
                localStorage.setItem('tokenNeraca', Date.now())
            } else {
                $('#text').show()
                $('#loading').hide()
                $('#password').addClass('is-invalid')
                $('#password-feedback').html('Kata sandi salah.')
                $('#submit').attr('disabled', false)
                $('#password').val('')
            }
        }
    })
})

let date = new Date()
let month = date.getMonth() + 1
month < 10 ? month = '0' + month : ''
$('#month').val(month)

localStorage.removeItem('tahunLabaRugi')
localStorage.removeItem('bulanLabaRugi')
if (localStorage.getItem('tahunNeraca') != null) $('#year').val(localStorage.getItem('tahunNeraca'))
if (localStorage.getItem('bulanNeraca') != null) $('#month').val(localStorage.getItem('bulanNeraca'))
let selectYear = $('#year').val()
let selectMonth = $('#month').val()
let now = selectYear + selectMonth
neraca(selectYear, selectMonth)

function neraca(y, m) {
    now = y + m
    localStorage.setItem('tahunNeraca', y)
    localStorage.setItem('bulanNeraca', m)
    $('#neraca').hide()
    $('#loader').show()
    $('#accountSection').html('')
    $('#download').attr('disabled', true)
    // $('#accountFilter').html('('+monthNames[parseInt(m-1)]+' '+y+')')
    $('iframe').attr('src', 'neraca/download/' + y + m)
    $.ajax({
        url: api_url + 'neraca/' + y + m,
        type: 'GET',
        dataType: 'JSON',
        headers: {
            'token-id': token
        },
        success: function(result) {
            $('#neraca').show()
            $('#loader').hide()

            let neracaSection = []
            $.each(result.accountSection, function(index, value) {
                neracaSection[index] = {
                    id: value.id,
                    total: 0
                }
            })
            let neracaGroup = []
            $.each(result.accountGroup, function(index, value) {
                neracaGroup[index] = {
                    id: value.id,
                    total: 0
                }
            })
            let neracaAccount = []
            $.each(result.accountname, function(index, value) {
                neracaAccount[index] = {
                    id: value.acc_code,
                    total: 0
                }
            })
            let neracaLaba = 0
            $.each(result.labaDiTahan.data, function(index, value) {
                neracaLaba += parseInt(value.amount)
            })

            $.each(result.journalReport.data, function(index, value) {
                // TOTAL SECTION
                sectionIndex = neracaSection.findIndex((obj => obj.id == value.section_id))
                neracaSection[sectionIndex].total += parseInt(value.amount)

                // TOTAL GROUP
                groupIndex = neracaGroup.findIndex((obj => obj.id == value.group_id))
                neracaGroup[groupIndex].total += parseInt(value.amount)

                // AMOUNT
                accountIndex = neracaAccount.findIndex((obj => obj.id == value.acc_code))
                neracaAccount[accountIndex].total += parseInt(value.amount)
            })

            // SALDO LABA (DEFISIT)
            sectionIndex = neracaSection.findIndex((obj => obj.id == '203'))
            neracaSection[sectionIndex].total += parseInt(neracaLaba)

            groupIndex = neracaGroup.findIndex((obj => obj.id == '6'))
            neracaGroup[groupIndex].total += parseInt(neracaLaba)

            // ACCOUNT SECTION
            let accountSection = ''
            $.each(result.accountSection, function(index, value) {
                accountSection +=
                    `<div class="grid border mt-4" id="accountSection` + value.id + `">
	                <p class="grid-header">` + value.parameter + `</p>
	                <div class="item-wrapper" id="accountGroup` + value.id + `"></div>
	            </div>`
            })
            $('#accountSection').prepend(accountSection)

            // ACCOUNT GROUP
            let accountGroup = ''
            $.each(result.accountGroup, function(index, value) {
                accountGroup =
                    `<p class="font-weight-bold pl-3 py-3">` + value.acc_group_name + `</p>
	            <div class="table-responsive">
	                <table class="table table-hover">
	                    <thead>
	                        <tr>
	                            <th class="font-weight-bold">Kode</th>
	                            <th class="font-weight-bold" width="500">Nama Akun</th>
	                            <th class="font-weight-bold text-right">Nilai</th>
	                        </tr>
	                    </thead>
	                    <tbody id="accountName` + value.id + `"></tbody>
	                </table>
	            </div>`
                $('#accountGroup' + value.section_id).append(accountGroup)
            })

            // ACCOUNT NAME
            let accountName = ''
            $.each(result.accountname, function(index, value) {
                accountName =
                    `<tr>
		            <td><a href="laporan-posisi-keuangan/account/` + value.id + `/` + y + m + `" class="text-danger">` + value.acc_code + `</a></td>
		            <td>` + value.acc_name + `</td>
		            <td class="text-right" id="amount` + value.acc_code + `">0</td>
		        </tr>`
                $('#accountName' + value.group_id).append(accountName)
            })

            let totalAccountGroup = ''
            $.each(result.accountGroup, function(index, value) {
                totalAccountGroup =
                    `<tr>
		            <td colspan="2" class="font-weight-bold text-right">Total ` + value.acc_group_name + `</td>
		            <td class="font-weight-bold text-right" id="totalGroup` + value.id + `">0</td>
		        </tr>`
                if (value.id == '6' || value.id == '7') {
                    let accountGroupName = 'Liabilitas & Ekuitas'
                    if (value.id == '7') {
                        accountGroupName = value.section_name
                    }
                    totalAccountGroup +=
                        `<tr class="text-right">
			            <td colspan="2"><h6>Total ` + accountGroupName + `</h6></td>
			            <td><h6 id="totalSection` + value.section_id + `">0</h6></td>
			        </tr>`
                }
                $('#accountName' + value.id).append(totalAccountGroup)
            })

            // Total Section
            $.each(result.accountSection, function(index, value) {
                sectionIndex = neracaSection.findIndex((obj => obj.id == value.id))
                $('#totalSection' + value.id).html(convertToRupiah(String(neracaSection[sectionIndex].total)))
            })

            // Total Group
            $.each(result.accountGroup, function(index, value) {
                groupIndex = neracaGroup.findIndex((obj => obj.id == value.id))
                $('#totalGroup' + value.id).html(convertToRupiah(String(neracaGroup[groupIndex].total)))
            })

            // Total Account
            $.each(result.accountname, function(index, value) {
                accountIndex = neracaAccount.findIndex((obj => obj.id == value.acc_code))
                if (value.acc_code != '3500') {
                    $('#amount' + value.acc_code).html(convertToNumber(String(neracaAccount[accountIndex].total)))
                } else {
                    $('#amount3500').html(convertToNumber(String(neracaLaba)))
                }
            })
        },
        complete: function() {
            $('#search').attr('disabled', false)
            $('#download').attr('disabled', false)
        }
    })
}

$('#search').click(function() {
    selectYear = $('#year').val()
    selectMonth = $('#month').val()
    neraca(selectYear, selectMonth)
    $(this).attr('disabled', true)
})

$('#download').click(function() {
    $(this).attr('disabled', true)
    $('#ico-d').hide()
    $('#ico-l').show()
    let element = $('iframe').contents().find('html').html()
    let opt = {
        margin: [0.2, 0.5],
        filename: 'laporan_posisi_keuangan_' + now.substr(0, 4) + '_' + now.substr(4, 2) + '.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
    }
    html2pdf().from(element).set(opt).toPdf().get('pdf').then(function(pdf) {
        var totalPages = pdf.internal.getNumberOfPages();
        for (i = 1; i <= totalPages; i++) {
            pdf.setPage(i);
            pdf.setFontSize(9);
            pdf.text(i + ' / ' + totalPages, (pdf.internal.pageSize.getWidth() - 0.8), (pdf.internal.pageSize.getHeight() - 0.8));
        }
        $('#download').attr('disabled', false)
        $('#ico-d').show()
        $('#ico-l').hide()
    }).save();
})