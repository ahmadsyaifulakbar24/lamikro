let stop = false

// Sektor Usaha
$.ajax({
    url: api_references + 'get_enum/azoh0Mee',
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
    url: api_references + 'get_enum/ve8ooKah',
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
//         $.each(result, function(index, value) {
//             // console.log(value)
//             append = `<option value="${value.id}">${value.parameter}</option>`
// 	        $('#jenis_usaha').append(append)
//         })
//     }
// })

$(document).ajaxStop(function() {
	stop == false ? get_data() : ''
})

function get_data() {
$.ajax({
    url: api_url + 'metadata/userdata',
    type: 'GET',
    dataType: 'JSON',
    headers: {
        'token-id': token
    },
    success: function(result) {
        // console.log(result)
        $('#company').val(result.company)
        $('#alamat_usaha').val(result.alamat_usaha)
        $('#enum_sektor').val(result.enum_sektor)
        $('#enum_bidang').val(result.enum_bidang)
        $('#tgl_b_us').val(result.tgl_b_us)
        $('#npwp_usaha').val(result.npwp_usaha)
        $('#iumkm').val(result.iumkm)
        result.kaya_usaha != '0' ? $('#kaya_usaha').val(convert(result.kaya_usaha)) : ''
        result.volume_usaha != '0' ? $('#volume_usaha').val(convert(result.volume_usaha)) : ''
        result.emp_amount != '0' ? $('#emp_amount').val(convert(result.emp_amount)) : ''
        result.capacity != '0' ? $('#capacity').val(result.capacity) : ''
        $('#koperasi').val(result.koperasi)
        if (result.enum_sektor == null || result.enum_bidang == null || result.tgl_b_us == '0000-00-00' || result.npwp_usaha == '') {
        	$('#warning').show()
        }
        stop = true
    },
    complete: function() {
        $('#submit').attr('disabled', false)
    }
})
}

$('#form').submit(function(e) {
    e.preventDefault()
    $('#loading').show()
    $('#submit').attr('disabled', true)
    $('.is-invalid').removeClass('is-invalid')

    let company = $('#company').val()
    let alamat_usaha = $('#alamat_usaha').val()
    let enum_sektor = $('#enum_sektor').val()
    let enum_bidang = $('#enum_bidang').val()
    let tgl_b_us = $('#tgl_b_us').val()
    let npwp_usaha = $('#npwp_usaha').val()
    let iumkm = $('#iumkm').val()
    let kaya_usaha = number($('#kaya_usaha').val())
    let volume_usaha = number($('#volume_usaha').val())
    let emp_amount = number($('#emp_amount').val())
    let capacity = $('#capacity').val()
    let koperasi = $('#koperasi').val()

    $.ajax({
        url: api_url + 'updateProfileUsaha',
        type: 'POST',
        dataType: 'JSON',
        headers: {
            'token-id': token
        },
        data: {
            company: company,
            alamat_usaha: alamat_usaha,
            enum_sektor: enum_sektor,
            enum_bidang: enum_bidang,
            tgl_b_us: tgl_b_us,
            npwp_usaha: npwp_usaha,
            iumkm: iumkm,
            kaya_usaha: kaya_usaha,
            volume_usaha: volume_usaha,
            emp_amount: emp_amount,
            capacity: capacity,
            koperasi: koperasi
        },
        success: function(result) {
            if (result.status == true) {
                $('#warning').hide()
                $('#alert').show()
                $('html, body').scrollTop(0)
                setTimeout(function() {
                    $('#alert').hide()
                }, 3000)
            }
        },
        complete: function() {
            $('#loading').hide()
            $('#submit').attr('disabled', false)
        }
    })
})