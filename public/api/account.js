$.ajax({
	url: api_url+'metadata/userdata',
	type: 'GET',
	dataType: 'JSON',
	headers: {
		'token-id': token
	},
	success: function(result) {
		if(result.status != false) {
			let avatar = 'https://lamikro.com/e_gl/api/logo/'+result.avatar
			if(result.avatar == '' || result.avatar == null) {
				avatar = 'https://lamikro.com/public/images/store/business.svg'
			}
			$('.profile-img').attr('src',avatar)
			$('#accountName').html(result.name)
			$('#accountEmail').html(result.email)
	    	$('#accountCompany').html(result.company)
	    } else {
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
	}
})