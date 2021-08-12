function captcha() {
	const a = Math.floor(Math.random() * 10)
	const b = Math.floor(Math.random() * 10)
	window.c = a + b
	$('#text-captcha').html(a+' + '+b+' = ')
}
captcha()

$('#form').submit(function(e){
	e.preventDefault()
	validateKTP()
	validateName()
	validateNPWP()
	validateEmail()
	validatePhone()
	validateBusinessName()
	validateBusinessNumber()
	validateBusinessAddress()
	validateUsername()
	validatePassword()
	validateConfirmPassword()
	validateCaptcha()

	$('#text').hide()
	$('#loading').show()
	$('#submit').attr('disabled',true)

	let ktp = $('#ktp').val()
	let name = $('#name').val()
	let npwp = $('#npwp').val()
	let email = $('#email').val()
	let phone = $('#phone').val()
	let businessName = $('#businessName').val()
	let businessNumber = $('#businessNumber').val()
	let businessAddress = $('#businessAddress').val()
	let username = $('#username').val()
	let password = $('#password').val()
	let captcha = $('#captcha').val()

	if(sktp == true && sname == true && semail == true && sphone == true && sbusinessName == true && sbusinessNumber == true && sbusinessAddress == true && susername == true && spassword == true && scpassword == true && scaptcha == true) {
		$.ajax({
			url: api_url+'register',
			type: 'POST',
			dataType: 'JSON',
			data: {
				nik: ktp,
				fullname: name,
				npwp: npwp,
				email: email,
				no_hp: phone,
				company: businessName,
				iumkm: businessNumber,
				address: businessAddress,
				username: username,
				password: password
			},
			success: function(result) {
				if(result.status == true) {
					$('#regis').hide()
					$('#done').show()
				} else {
					if(result.message == 'Username already exists') {
						$('#username').addClass('is-invalid')
						$('#username-feedback').html('Nama akun telah digunakan.')
						$('html, body').scrollTop(800)
					}
					else if(result.message == 'Username & Email already exists') {
						$('#username').addClass('is-invalid')
						$('#username-feedback').html('Nama akun telah digunakan.')
						$('#email').addClass('is-invalid')
						$('#email-feedback').html('Email telah digunakan.')
						$('html, body').scrollTop(350)
					}
					else if(result.message == 'Email already exists') {
						$('#email').addClass('is-invalid')
						$('#email-feedback').html('Email telah digunakan.')
						$('html, body').scrollTop(350)
					}
					$('#text').show()
					$('#loading').hide()
					$('#submit').attr('disabled',false)
				}
			}
		})
	} else {
		$('#text').show()
		$('#loading').hide()
		$('#submit').attr('disabled',false)
	}
})