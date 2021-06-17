$.ajax({
	url: api_url+'jenisUsaha',
	type: 'GET',
	dataType: 'JSON',
	headers: {
		'token-id': token
	},
	success: function(result) {
		let append = '<option disabled selected>Pilih</option>'
		$.each(result, function(index, value){
			append += `<option value="`+value.id+`">`+value.parameter+`</option>`
		})
		$('#businessType').append(append)
	},
	complete: function(){
		$.ajax({
			url: api_url+'metadata/userdata',
			type: 'GET',
			dataType: 'JSON',
			headers: {
				'token-id': token
			},
			success: function(result) {
				$('#businessName').val(result.company)
				$('#businessType').val(result.jenis_usaha)
				$('#businessNumber').val(result.iumkm)
				$('#businessAddress').val(result.alamat_usaha)
			},
			complete: function(){
				$('#submit').attr('disabled',false)
			}
		})
	}
})