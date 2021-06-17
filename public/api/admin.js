$.ajax({
	url: api_url+'metadata/userdata',
	type: 'GET',
	dataType: 'JSON',
	headers: {
		'token-id': token
	},
	success: function(result) {
		if(result.ref_group_user == "J1") {
			$.ajax({
				url: api_url+'lamikroSummaryUser',
				type: 'GET',
				dataType: 'JSON',
				headers: {
					'token-id': token
				},
				success: function(result) {
					$.each(result.data, function(index, value){
						$('#total').html(convertToNumber(value.jumlah))
					})
				}
			})
		} else {
			$(location).attr('href','dashboard')
		}
	}
})