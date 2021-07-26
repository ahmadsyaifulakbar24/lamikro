// Agama
$.ajax({
    url: `${api_references}get_enum/MeeZae5i`,
    type: 'GET',
    dataType: 'JSON',
    success: function(result) {
        $.each(result, function(index, value) {
            // console.log(value)
            append = `<option value="${value.id}">${value.parameter}</option>`
            $('#enum_religi').append(append)
        })
    }
})

// Pendidikan
$.ajax({
    url: `${api_references}get_enum/ja4oux6I`,
    type: 'GET',
    dataType: 'JSON',
    success: function(result) {
        $.each(result, function(index, value) {
            // console.log(value)
            append = `<option value="${value.id}">${value.parameter}</option>`
            $('#enum_edu').append(append)
        })
    }
})

// Provinsi
$.ajax({
    url: `${api_references}get_provinsi`,
    type: 'GET',
    dataType: 'JSON',
    success: function(result) {
        // console.log(result)
        $.each(result, function(index, value) {
            append = `<option value="${value.id}">${value.value}</option>`
            $('#enum_prov').append(append)
        })
    }
})

// Kabupaten/Kota
function get_kota(province, districts) {
    $.ajax({
        url: `${api_references}get_kota/${province}`,
        type: 'GET',
        dataType: 'JSON',
        success: function(result) {
            // console.log(result)
            $('#enum_city').html(`<option value="" disabled selected>Pilih</option>`)
            $.each(result, function(index, value) {
                append = `<option value="${value.id}">${value.value}</option>`
                $('#enum_city').append(append)
            })
            $('#enum_city').val(districts)
        }
    })
}

$('#enum_prov').change(function() {
    get_kota($(this).val())
})

// Sektor Usaha
$.ajax({
    url: `${api_references}get_enum/azoh0Mee`,
    type: 'GET',
    dataType: 'JSON',
    success: function(result) {
        $.each(result, function(index, value) {
            // console.log(value)
            append = `<option value="${value.id}">${value.parameter}</option>`
            $('#enum_sektor').append(append)
        })
    }
})

// Bidang Usaha
$.ajax({
    url: `${api_references}get_enum/ve8ooKah`,
    type: 'GET',
    dataType: 'JSON',
    success: function(result) {
        $.each(result, function(index, value) {
            // console.log(value)
            append = `<option value="${value.id}">${value.parameter}</option>`
            $('#enum_bidang').append(append)
        })
    }
})

// Jenis Usaha
// $.ajax({
//     url: api_url + 'jenisUsaha',
//     type: 'GET',
//     dataType: 'JSON',
//     headers: {
//         'token-id': token
//     },
//     success: function(result) {
//         $('#jenis_usaha').html(`<option value="" disabled selected>Pilih</option>`)
//         $.each(result, function(index, value) {
//             append = `<option value="${value.id}">${value.parameter}</option>`
// 	        $('#jenis_').append(append)
//         })
//     }
// })

let stop = false

$(document).ajaxStop(function() {
    stop == false ? get_data() : ''
})

let no_ktp,
	npwp,
	tmp_lahir,
	tgl_lahir,
	phone_number,
	address,
	alamat_usaha,
	tgl_b_us,
	iumkm,
	npwp_usaha,
	emp_amount,
	koperasi

function get_data() {
    $.ajax({
        url: `${api_kitchensink}namuV3ey/${user_id}`,
        type: 'GET',
        dataType: 'JSON',
        headers: {
            'token-id': token,
        },
        success: function(result) {
            // console.log(result)
            if (result != '') {
                let value = result[0]
                $('#username').val(value.username)
                $('#name').val(value.name)
                if (value.gender != '') {
                    if (value.gender == 'L') {
                        $('#male').attr('checked', true)
                    } else {
                        $('#female').attr('checked', true)
                    }
                }
                $('#enum_religi').val(value.religi_)
                $('#no_ktp').val(value.no_ktp); no_ktp = value.no_ktp
                $('#npwp').val(value.npwp); npwp = value.npwp
                $('#tmp_lahir').val(value.tmp_lahir); tmp_lahir = value.tmp_lahir
                $('#tgl_lahir').val(value.tgl_lahir); tgl_lahir = value.tgl_lahir
                $('#enum_edu').val(value.edu_)
                $('#phone_number').val(value.phone_number); phone_number = value.phone_number
                $('#email').val(value.email)
                $('#address').val(value.address); address = value.address
                $('#enum_prov').val(value.provinsi_)
                get_kota(value.provinsi_, value.kab_kota_)

                $('#company').val(value.company)
                $('#alamat_usaha').val(value.alamat_usaha); alamat_usaha = value.alamat_usaha
                $('#enum_sektor').val(value.sektor_)
                $('#enum_bidang').val(value.bidang_)
                $('#tgl_b_us').val(value.tgl_b_us); tgl_b_us = value.tgl_b_us
                $('#iumkm').val(value.iumkm); iumkm = value.iumkm
                $('#npwp_usaha').val(value.npwp_usaha); npwp_usaha = value.npwp_usaha
                value.kaya_usaha != '0' ? $('#kaya_usaha').val(convert(value.kaya_usaha)) : ''
                value.volume_usaha != '0' ? $('#volume_usaha').val(convert(value.volume_usaha)) : ''
                if (value.emp_amount != '0') {
                	$('#emp_amount').val(convert(value.emp_amount))
                	emp_amount = value.emp_amount
                }
                value.capacity != '0' ? $('#capacity').val(value.capacity) : ''
                if (value.koperasi == 'Ya') {
                	$('#koperasi').val(1)
                	koperasi = 1
                } else {
                	$('#koperasi').val(0)
                	koperasi = 0
                }

                $('#submit').attr('disabled', false)
            } else {
                window.history.back()
            }
        },
        complete: function() {
            stop = true
        }
    })
}

$('#form').submit(function(e) {
    e.preventDefault()
    $('#loading').show()
    $('#submit').attr('disabled', true)
    $('.is-invalid').removeClass('is-invalid')

    $.ajax({
        url: `${api_kitchensink}namuV3ey/u/${user_id}`,
        type: 'POST',
        dataType: 'JSON',
        headers: {
            'token-id': token
        },
        data: {
            name: $('#name').val(),
            gender: $('input[type=radio][name=gender]:checked').val(),
            enum_religi: $('#enum_religi').val(),
            no_ktp: no_ktp,
            npwp: npwp,
            tmp_lahir: tmp_lahir,
            tgl_lahir: tgl_lahir,
            enum_edu: $('#enum_edu').val(),
            phone_number: phone_number,
            address: address,
            enum_prov: $('#enum_prov').val(),
            enum_city: $('#enum_city').val(),

			company: $('#company').val(),
			alamat_usaha: alamat_usaha,
			enum_sektor: $('#enum_sektor').val(),
			enum_bidang: $('#enum_bidang').val(),
			tgl_b_us: tgl_b_us,
			iumkm: iumkm,
			npwp_usaha: npwp_usaha,
			kaya_usaha: number($('#kaya_usaha').val()),
			volume_usaha: number($('#volume_usaha').val()),
			emp_amount: emp_amount,
			capacity: $('#capacity').val(),
			koperasi: koperasi
        },
        success: function(result) {
        	// console.log(result)
            if (result.status == true) {
                $('#warning').hide()
            	$('#alert').show()
            	$('html, body').scrollTop(0)
            	setTimeout(function() {
            		$('#alert').hide()
            	}, 3000)
            } else {
                if (result.message == 'Username already exists') {
                    $('#username').addClass('is-invalid')
                    $('#username').siblings('div').html('Nama akun telah digunakan.')
                    $('html, body').scrollTop(50)
                } else if (result.message == 'Email already exists') {
                    $('#email').addClass('is-invalid')
                    $('#email').siblings('div').html('Email telah digunakan.')
                    $('html, body').scrollTop(500)
                } else if (result.message == 'Username & Email already exists') {
                    $('#username').addClass('is-invalid')
                    $('#username').siblings('div').html('Nama akun telah digunakan.')
                    $('#email').addClass('is-invalid')
                    $('#email').siblings('div').html('Email telah digunakan.')
                    $('html, body').scrollTop(50)
                }
            }
        },
        complete: function() {
            $('#loading').hide()
            $('#submit').attr('disabled', false)
        }
    })
})

$('#form-password').submit(function(e) {
    e.preventDefault()
    $('#loading-password').show()
    $('#submit-password').attr('disabled', true)
    let npassword = $('#npassword').val()
    $.ajax({
        url: `${api_kitchensink}namuV3ey/p/${user_id}`,
        type: 'POST',
        dataType: 'JSON',
        headers: {
            'token-id': token
        },
        data: {
            password: npassword
        },
        success: function(result) {
            $('#loading-password').hide()
            $('#submit-password').attr('disabled', false)
            $('#npassword').val('')
            $('#alert-password').show()
            setTimeout(function() {
                $('#alert-password').hide()
            }, 3000)
        }
    })
})