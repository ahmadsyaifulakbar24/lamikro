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
                // Pengguna
                $('#username').val(value.username)
                $('#name').val(value.name)
                $('#no_ktp').val(value.no_ktp)
                $('#npwp').val(value.npwp)
                $('#tmp_lahir').val(value.tmp_lahir)
                $('#tgl_lahir').val(value.tgl_lahir)
                if (value.gender != '') {
                    if (value.gender == 'L') {
                        $('#male').attr('checked', true)
                    } else {
                        $('#female').attr('checked', true)
                    }
                }
                $('#enum_religi').val(value.religi_)
                $('#enum_edu').val(value.edu_)
                $('#enum_prov').val(value.provinsi_)
                get_kota(value.provinsi_, value.kab_kota_)
                $('#address').val(value.address)
                $('#email').val(value.email)
                $('#phone_number').val(value.phone_number)

                // Usaha
                $('#company').val(value.company)
                $('#alamat_usaha').val(value.alamat_usaha)
                $('#enum_sektor').val(value.sektor_)
                $('#enum_bidang').val(value.bidang_)
                $('#tgl_b_us').val(value.tgl_b_us)
                $('#npwp_usaha').val(value.npwp_usaha)
                $('#iumkm').val(value.iumkm)
                value.kaya_usaha != '0' ? $('#kaya_usaha').val(convert(value.kaya_usaha)) : ''
                value.volume_usaha != '0' ? $('#volume_usaha').val(convert(value.volume_usaha)) : ''
                value.emp_amount != '0' ? $('#emp_amount').val(convert(value.emp_amount)) : ''
                value.capacity != '0' ? $('#capacity').val(value.capacity) : ''
                value.koperasi == 'Ya' ? $('#koperasi').val(1) : $('#koperasi').val(0)

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
            username: $('#username').val(),
            name: $('#name').val(),
            no_ktp: $('#no_ktp').val(),
            npwp: $('#npwp').val(),
            tmp_lahir: $('#tmp_lahir').val(),
            tgl_lahir: $('#tgl_lahir').val(),
            gender: $('input[type=radio][name=gender]:checked').val(),
            enum_religi: $('#enum_religi').val(),
            enum_edu: $('#enum_edu').val(),
            enum_prov: $('#enum_prov').val(),
            enum_city: $('#enum_city').val(),
            address: $('#address').val(),
            email: $('#email').val(),
            phone_number: $('#phone_number').val(),

			company: $('#company').val(),
			alamat_usaha: $('#alamat_usaha').val(),
			enum_sektor: $('#enum_sektor').val(),
			enum_bidang: $('#enum_bidang').val(),
			tgl_b_us: $('#tgl_b_us').val(),
			npwp_usaha: $('#npwp_usaha').val(),
			iumkm: $('#iumkm').val(),
			kaya_usaha: number($('#kaya_usaha').val()),
			volume_usaha: number($('#volume_usaha').val()),
			emp_amount: number($('#emp_amount').val()),
			capacity: $('#capacity').val(),
			koperasi: $('#koperasi').val()
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