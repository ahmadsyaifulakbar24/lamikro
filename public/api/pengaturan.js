$('#form').submit(function(e){
	e.preventDefault()
	validateCurrentPassword()
	validateNewPassword()
	validateConfirmNewPassword()

	$('#loading').show()
	$('#submit').attr('disabled',true)

	let password = $('#password').val()
	let npassword = $('#npassword').val()
	let cpassword = $('#cpassword').val()

	if(spassword == true && snpassword == true && scpassword == true) {
		$.ajax({
			url: api_url+'verifyPassword',
			type: 'POST',
			dataType: 'JSON',
			headers: {
				'token-id': token
			},
			data: {
				password: password
			},
			success: function(result) {
				if(result.status == true) {
					$.ajax({
						url: api_url+'changePassword',
						type: 'POST',
						dataType: 'JSON',
						headers: {
							'token-id': token
						},
						data: {
							oldpassword: password,
							password: npassword
						},
						success: function(result) {
							$('#loading').hide()
							$('#submit').attr('disabled',false)
							$('#password').focus()
							$('#password').val('')
							$('#npassword').val('')
							$('#cpassword').val('')
							$('#alert').show()
							$('html, body').scrollTop(0)
							setTimeout(function(){
								$('#alert').hide()
							},3000)
						}
					})
				} else {
					$('#loading').hide()
					$('#submit').attr('disabled',false)
					$('#password').focus()
					$('#password').val('')
					$('#npassword').val('')
					$('#cpassword').val('')
					$('#password').addClass('is-invalid')
					$('#password-feedback').html('Kata sandi salah.')
				}
			}
		})
	} else {
		$('#loading').hide()
		$('#submit').attr('disabled',false)
	}
})