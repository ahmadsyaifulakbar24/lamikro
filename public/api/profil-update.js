$('#form').submit(function(e){
	e.preventDefault()
	validateUsername()
	validateName()
	validateKTP()
	validateNPWP()
	validateDate()
	validateGender()
	validateAddress()
	validateEmail()
	validatePhone()

	$('#loading').show()
	$('#submit').attr('disabled',true)
	let username = $('#username').val()
	let name = $('#name').val()
	let ktp = $('#ktp').val()
	let npwp = $('#npwp').val()
	let date = $('#date').val()
	let gender = $('input[type=radio][name=gender]:checked').val()
	let address = $('#address').val()
	let email = $('#email').val()
	let phone = $('#phone').val()

	if(susername == true && sname == true && sktp == true && snpwp == true && sdate == true && sgender == true && saddress == true && semail == true && sphone == true) {
		$.ajax({
			url: api_url+'updateProfile',
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
				tgl_lahir: date,
				gender: gender,
				address: address,
				email: email,
				phone_number: phone
			},
			success: function(result) {
				$('#username').removeClass('is-invalid')
				$('#email').removeClass('is-invalid')
				if(result.status == true) {
					$('#alert').show()
					$('html, body').scrollTop(0)
					setTimeout(function(){
						$('#alert').hide()
					},3000)
				}
				else {
					if(result.message == 'Username already exists') {
						$('#username').addClass('is-invalid')
						$('#username-feedback').html('Nama akun telah terpakai.')
						$('html, body').scrollTop(50)
					}
					else if(result.message == 'Email already exists') {
						$('#email').addClass('is-invalid')
						$('#email-feedback').html('Email telah terpakai.')
						$('html, body').scrollTop(500)
					}
					else if(result.message == 'Username & Email already exists') {
						$('#username').addClass('is-invalid')
						$('#username-feedback').html('Nama akun telah terpakai.')
						$('#email').addClass('is-invalid')
						$('#email-feedback').html('Email telah terpakai.')
						$('html, body').scrollTop(50)
					}
				}
			},
			complete: function() {
				$('#loading').hide()
				$('#submit').attr('disabled',false)
			}
		})
	} else {
		$('#loading').hide()
		$('#submit').attr('disabled',false)
		if(susername == false || sname == false || sktp == false) {
			$('html, body').scrollTop(50)
		}
	}
})