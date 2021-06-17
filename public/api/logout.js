$('#logout').click(function(){
	$.ajax({
		url: api_url+'logout',
		type: 'GET',
		dataType: 'JSON',
		headers: {
			'token-id': token
		},
		success: function(result) {
			$.ajax({
				url: '/session/logout',
				type: 'GET',
				success: function(){
					localStorage.removeItem('token')
					localStorage.clear()
					window.location.href = '/app'
			
				}
			})
		}
	})
})