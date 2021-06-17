$('#form').submit(function(e){
	e.preventDefault()
	$('#text').hide()
	$('#loading').show()
	$('#submit').attr('disabled',true)
	$('#email').removeClass('is-invalid')
	let email = $('#email').val()
	$.ajax({
		url: api_url+'resetPassword',
		type: 'POST',
		dataType: 'JSON',
		data: {
			email: email
		},
		success: function(result) {
			if(result.status == true) {
				$('#form').hide()
				$('#codeFeedback').show()
			} else {
				$('#email').focus()
				$('#email').addClass('is-invalid')
				$('#submit').attr('disabled',false)
				$('#text').show()
				$('#loading').hide()
			}
		}
	})
})