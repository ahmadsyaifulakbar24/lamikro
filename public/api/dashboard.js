$.ajax({
	url: api_url+'metadata/userdata',
	type: 'GET',
	dataType: 'JSON',
	headers: {
		'token-id': token
	},
	success: function(value) {
		$('#nama_usaha').html(value.company)
		$('#iumk').html(value.iumkm)
		$('#alamat_usaha').html(value.alamat_usaha)
	}
})