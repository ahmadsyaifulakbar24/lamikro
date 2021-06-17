if (localStorage.getItem('tokenLabaRugi') != null) {
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
                localStorage.setItem('tokenLabaRugi', Date.now())
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

let url = ''
let date = new Date()
let month = date.getMonth() + 1
month < 10 ? month = '0' + month : ''
$('#month').val(month)

localStorage.removeItem('tahunNeraca')
localStorage.removeItem('bulanNeraca')
if (localStorage.getItem('tahunLabaRugi') != null) $('#year').val(localStorage.getItem('tahunLabaRugi'))
if (localStorage.getItem('bulanLabaRugi') != null) $('#month').val(localStorage.getItem('bulanLabaRugi'))
let selectYear = $('#year').val()
let selectMonth = $('#month').val()
let now = selectYear + selectMonth
labaRugi(selectYear, selectMonth)

function labaRugi(y, m) {
    now = y + m
    localStorage.setItem('tahunLabaRugi', y)
    localStorage.setItem('bulanLabaRugi', m)
    $('#labarugi').hide()
    $('#loader').show()
    $('#accountSection').html('')
    $('#download').attr('disabled', true)
    // $('#accountFilter').html('('+monthNames[parseInt(m-1)]+' '+y+')')
    $('iframe').attr('src', 'labarugi/download/' + y + m)
    url = api_url + 'labaRugi/' + y + '/' + m
    if (m == '' || m == null) url = api_url + 'labaRugi/' + y
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON',
        headers: {
            'token-id': token
        },
        success: function(result) {
            $('#labarugi').show()
            $('#loader').hide()

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

            $.each(result.journalReport, function(index, value) {
                // TOTAL GROUP
                groupIndex = neracaGroup.findIndex((obj => obj.id == value.group_id))
                neracaGroup[groupIndex].total += parseInt(value.amount)

                // AMOUNT
                accountIndex = neracaAccount.findIndex((obj => obj.id == value.acc_code))
                neracaAccount[accountIndex].total += parseInt(value.amount)
            })

            let accountGroup = ''
            $.each(result.accountGroup, function(index, value) {
                accountGroup +=
                    `<div class="grid border mt-4" id="accountSection` + value.id + `">
	                <p class="grid-header">` + value.section_name + `</p>
	                <div class="item-wrapper" id="accountGroup` + value.id + `">
			            <div class="table-responsive">
			                <table class="table table-hover">
			                    <thead>
			                        <tr>
			                            <th class="font-weight-bold">Kode</th>
			                            <th class="font-weight-bold width="500">Nama Akun</th>
			                            <th class="font-weight-bold text-right">Nilai</th>
			                        </tr>
			                    </thead>
			                    <tbody id="accountName` + value.id + `"></tbody>
			                </table>
			            </div>
	                </div>
	            </div>`
            })
            $('#accountSection').append(accountGroup)

            let accountName = ''
            $.each(result.accountname, function(index, value) {
                accountName =
                    `<tr>
		            <td><a href="laporan-laba-rugi/account/` + value.id + `/` + y + m + `" class="text-danger">` + value.acc_code + `</a></td>
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
		            <td class="font-weight-bold text-right" id="totalGroup` + value.id + `">Rp0</td>
		        </tr>`
                if (value.id == '2') {
                    totalAccountGroup +=
                        `<tr class="text-right">
			            <td colspan="2"><h6>Laba (Rugi) Sebelum Pajak</h6></td>
			            <td><h6 id="profitNLossBeforeTax">Rp0</h6></td>
			        </tr>
			        <tr class="text-right">
			            <td colspan="2"><h6>Biaya Pajak Penghasilan</h6></td>
			            <td><h6 id="profitLossPercentage">Rp0</h6></td>
			        </tr>
			        <tr class="text-right">
			            <td colspan="2"><h6>Laba (Rugi) Setelah Pajak</h6></td>
			            <td><h6 id="profitNLossBeforeTaxFinal">Rp0</h6></td>
			        </tr>`
                }
                $('#accountName' + value.id).append(totalAccountGroup)
            })

            // Total Group
            $.each(result.accountGroup, function(index, value) {
                groupIndex = neracaGroup.findIndex((obj => obj.id == value.id))
                $('#totalGroup' + value.id).html(convertToRupiah(String(neracaGroup[groupIndex].total)))
            })

            // Total Account
            $.each(result.accountname, function(index, value) {
                accountIndex = neracaAccount.findIndex((obj => obj.id == value.acc_code))
                $('#amount' + value.acc_code).html(convertToNumber(String(neracaAccount[accountIndex].total)))
            })

            let labaRugiSebelumPajak = result.profitNLossBeforeTax.toString().substr(0, 1)
            if (labaRugiSebelumPajak == '-') {
            	$('#profitNLossBeforeTax').addClass('text-danger')
	            $('#profitNLossBeforeTax').html(`(${convertToRupiah(String(result.profitNLossBeforeTax))})`)
            } else {
            	$('#profitNLossBeforeTax').addClass('text-primary')
	            $('#profitNLossBeforeTax').html(convertToRupiah(String(result.profitNLossBeforeTax)))
	        }

            $('#profitLossPercentage').html(convertToRupiah(String(result.profitLossPercentage)))

            let labaRugiSesudahPajak = result.profitNLossBeforeTaxFinal.toString().substr(0, 1)
            if (labaRugiSesudahPajak == '-') {
            	$('#profitNLossBeforeTaxFinal').addClass('text-danger')
	            $('#profitNLossBeforeTaxFinal').html(`(${convertToRupiah(String(result.profitNLossBeforeTaxFinal))})`)
            } else {
            	$('#profitNLossBeforeTaxFinal').addClass('text-primary')
	            $('#profitNLossBeforeTaxFinal').html(convertToRupiah(String(result.profitNLossBeforeTaxFinal)))
	        }
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
    labaRugi(selectYear, selectMonth)
    $(this).attr('disabled', true)
})

$('#download').click(function() {
    $(this).attr('disabled', true)
    $('#ico-d').hide()
    $('#ico-l').show()
    let filename = 'laporan_laba_rugi_' + now.substr(0, 4) + '_' + now.substr(4, 2) + '.pdf'
    if (now.length == 4) filename = 'laporan_laba_rugi_' + now + '.pdf';
    let element = $('iframe').contents().find('html').html()
    let opt = {
        margin: [0.2, 0.5],
        filename: filename,
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