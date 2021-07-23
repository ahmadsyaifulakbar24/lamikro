// Agama
$.ajax({
    url: api_references + 'get_enum/MeeZae5i',
    type: 'GET',
    dataType: 'JSON',
    success: function(result) {
        $.each(result, function(index, value) {
            // console.log(value)
            append = `<option value="${value.id}">${value.parameter}</option>`
            $('#religi_').append(append)
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
            $('#edu_').append(append)
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
            $('#provinsi_').append(append)
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
            $('#kab_kota_').html(`<option value="" disabled selected>Pilih</option>`)
            $.each(result, function(index, value) {
                append = `<option value="${value.id}">${value.value}</option>`
                $('#kab_kota_').append(append)
            })
            $('#kab_kota_').val(districts)
        }
    })
}

$('#provinsi_').change(function() {
    get_kota($(this).val())
})

// Sektor Usaha
$.ajax({
    url: api_references + 'get_enum/azoh0Mee',
    type: 'GET',
    dataType: 'JSON',
    success: function(result) {
        $.each(result, function(index, value) {
            // console.log(value)
            append = `<option value="${value.id}">${value.parameter}</option>`
            $('#sektor_').append(append)
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
            $('#bidang_').append(append)
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
	            $('#religi_').val(value.religi_)
	            $('#edu_').val(value.edu_)
	            $('#provinsi_').val(value.provinsi_)
	            get_kota(value.provinsi_, value.kab_kota_)
	            $('#address').val(value.address)
	            $('#email').val(value.email)
	            $('#phone_number').val(value.phone_number)

	            // Usaha
	            $('#company').val(value.company)
	            $('#alamat_usaha').val(value.alamat_usaha)
	            $('#sektor_').val(value.sektor_)
	            $('#bidang_').val(value.bidang_)
	            $('#tgl_b_us').val(value.tgl_b_us)
	            $('#npwp_usaha').val(value.npwp_usaha)
	            $('#iumkm').val(value.iumkm)
	            value.kaya_usaha != '0' ? $('#kaya_usaha').val(value.kaya_usaha) : ''
	            value.volume_usaha != '0' ? $('#volume_usaha').val(value.volume_usaha) : ''
	            value.emp_amount != '0' ? $('#emp_amount').val(value.emp_amount) : ''
	            value.capacity != '0' ? $('#capacity').val(value.capacity) : ''
	            value.koperasi == 'Ya' ? $('#koperasi').val(1) : $('#koperasi').val(0)
	        } else {
	        	window.history.back()
	        }
	    },
	    complete: function() {
	    	stop = true
	    }
	})
}
