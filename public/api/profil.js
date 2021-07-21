// Agama
$.ajax({
    url: api_references + 'get_enum/MeeZae5i',
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
    url: api_references + 'get_enum/ja4oux6I',
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
    url: api_references + 'get_provinsi',
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
        url: api_references + 'get_kota/' + province,
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

$.ajax({
    url: api_url + 'metadata/userdata',
    type: 'GET',
    dataType: 'JSON',
    headers: {
        'token-id': token
    },
    success: function(result) {
        // console.log(result)
        $('#username').val(result.username)
        $('#name').val(result.name)
        $('#ktp').val(result.no_ktp)
        $('#npwp').val(result.npwp)
        $('#tmp_lahir').val(result.tmp_lahir)
        $('#date').val(result.tgl_lahir)
        $('#enum_religi').val(result.enum_religi)
        $('#enum_edu').val(result.enum_edu)
        $('#enum_prov').val(result.enum_prov)
        get_kota(result.enum_prov, result.enum_city)
        $('#address').val(result.address)
        $('#email').val(result.email)
        $('#phone').val(result.phone_number)
        if (result.gender == "L") {
            $('#male').attr('checked', true)
        } else if (result.gender == "P") {
            $('#female').attr('checked', true)
        }
        if (result.tmp_lahir == '' || result.enum_religi == null || result.enum_edu == null || result.enum_prov == null || result.enum_city == null) {
            $('#warning').show()
        }
        $('#submit').attr('disabled', false)
    }
})

$('#form').submit(function(e) {
    e.preventDefault()
    $('#loading').show()
    $('#submit').attr('disabled', true)
    $('.is-invalid').removeClass('is-invalid')

    let username = $('#username').val()
    let name = $('#name').val()
    let ktp = $('#ktp').val()
    let npwp = $('#npwp').val()
    let tmp_lahir = $('#tmp_lahir').val()
    let date = $('#date').val()
    let gender = $('input[type=radio][name=gender]:checked').val()
    let enum_religi = $('#enum_religi').val()
    let enum_edu = $('#enum_edu').val()
    let enum_prov = $('#enum_prov').val()
    let enum_city = $('#enum_city').val()
    let address = $('#address').val()
    let email = $('#email').val()
    let phone = $('#phone').val()

    $.ajax({
        url: api_url + 'updateProfile',
        type: 'POST',
        dataType: 'JSON',
        headers: {
            'token-id': token
        },
        data: {
            username: username,
            name: name,
            no_ktp: ktp,
            npwp: npwp,
            tmp_lahir: tmp_lahir,
            tgl_lahir: date,
            gender: gender,
            enum_religi: enum_religi,
            enum_edu: enum_edu,
            enum_prov: enum_prov,
            enum_city: enum_city,
            address: address,
            email: email,
            phone_number: phone
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
                    $('#username').siblings('div').html('Nama akun telah terpakai.')
                    $('html, body').scrollTop(50)
                } else if (result.message == 'Email already exists') {
                    $('#email').addClass('is-invalid')
                    $('#email').siblings('div').html('Email telah terpakai.')
                    $('html, body').scrollTop(500)
                } else if (result.message == 'Username & Email already exists') {
                    $('#username').addClass('is-invalid')
                    $('#username').siblings('div').html('Nama akun telah terpakai.')
                    $('#email').addClass('is-invalid')
                    $('#email').siblings('div').html('Email telah terpakai.')
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