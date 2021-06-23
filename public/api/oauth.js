$('#form').submit(function(e){
	e.preventDefault()
	$('#submit').attr('disabled',true)
	$('#text').hide()
	$('#loading').show()
	$('#username').removeClass('is-invalid')
	$('#feedback').hide()

	let username = $('#username').val()
	let password = $('#password').val()
	
	$.ajax({
		url: api_url+'oauth',
		type: 'POST',
		dataType: 'JSON',
		data: {
			username: username,
			password: password
		},
		success: function(result) {
			let status = result.status
			let token = result.message
			if(status == true) {
				$.ajax({
					url: root+'session/oauth',
					type: 'GET',
					data: {
						token: token
					},
					success: function(result) {
						localStorage.setItem('token',token)
						$.ajax({
							url: api_url+'metadata/userdata',
							type: 'GET',
							dataType: 'JSON',
							headers: {
								'token-id': token
							},
							success: function(result) {
								if(result.ref_group_user == "J1") {
									$(location).attr('href','app/admin')
								} else {
									$(location).attr('href','app/dashboard')
								}
							}
						})
					}
				})
			} else {
				$('#submit').attr('disabled',false)
				$('#password').val('')
				$('#username').focus()
				$('#username').addClass('is-invalid')
				$('#feedback').show()
				$('#text').show()
				$('#loading').hide()
			}
		}
	})
})
