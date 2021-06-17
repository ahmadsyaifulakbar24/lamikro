$.ajax({
	url: api_url+'metadata/userdata',
	type: 'GET',
	dataType: 'JSON',
	headers: {
		'token-id': token
	},
	success: function(result) {
		$('#username').val(result.username)
		$('#name').val(result.name)
		$('#ktp').val(result.no_ktp)
		$('#npwp').val(result.npwp)
		$('#date').val(result.tgl_lahir)
		$('#address').val(result.address)
		$('#email').val(result.email)
		$('#phone').val(result.phone_number)
		if(result.gender == "L") {
            $('#male').attr('checked',true)
        } else if(result.gender == "P") {
            $('#female').attr('checked',true)
        }
	},
	complete: function(){
		$('#submit').attr('disabled',false)
	}
})