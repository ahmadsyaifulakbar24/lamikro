function npass() {
	let npassword = $('#npassword').val()
	window.snpassword = false
	if(npassword == '' || npassword == null) {
		$('#npassword').addClass('is-invalid')
		$('#npassword-feedback').html('Masukkan kata sandi baru.')
	}
	else if (npassword.length < 6) {
		$('#npassword').addClass('is-invalid')
		$('#npassword-feedback').html('Minimal 6 karakter.')
	}
	else {
		$('#npassword').removeClass('is-invalid')
		window.snpassword = true
	}
}
function cpass() {
	let npassword = $('#npassword').val()
	let cpassword = $('#cpassword').val()
	window.scpassword = false
	if(cpassword == '' || cpassword == null) {
		$('#cpassword').addClass('is-invalid')
		$('#cpassword-feedback').html('Masukkan konfirmasi kata sandi.')
	}
	else if (cpassword.length < 6) {
		$('#cpassword').addClass('is-invalid')
		$('#cpassword-feedback').html('Minimal 6 karakter.')
	}
	else if (npassword != cpassword) {
		$('#cpassword').addClass('is-invalid')
		$('#cpassword-feedback').html('Kata sandi tidak sama.')
	}
	else {
		$('#cpassword').removeClass('is-invalid')
		window.scpassword = true
	}
}

if(d.length < 32 || d == '') {
	$(location).attr('href','/app/reset_password')
} else {
	$('#form').submit(function(e){
		e.preventDefault()
		$('#text').hide()
		$('#loading').show()
		$('#submit').attr('disabled',true)
		let npassword = $('#npassword').val()
		let cpassword = $('#cpassword').val()
		cpass(); npass();
		if(snpassword == true && scpassword == true) {
			$.ajax({
				url: api_url+'newPassword',
				type: 'POST',
				dataType: 'JSON',
				headers: {
					'token-id': d
				},
				data: {
					password: npassword
				},
				success: function(result) {
					$('#step1').hide()
					$('#step2').show()
				}
			})
		} else {
			$('#text').show()
			$('#loading').hide()
			$('#submit').attr('disabled',false)
		}
	})
}