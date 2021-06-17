$('#form').submit(function(e){
	e.preventDefault()
	validateBusinessName()
	validateBusinessType()
	validateBusinessNumber()
	validateBusinessAddress()

	$('#loading').show()
	$('#submit').attr('disabled',true)
	let businessName = $('#businessName').val()
	let businessType = $('#businessType').val()
	let businessNumber = $('#businessNumber').val()
	let businessAddress = $('#businessAddress').val()

	if(sbusinessName == true && sbusinessType == true && sbusinessNumber == true && sbusinessAddress) {
		$.ajax({
			url: api_url+'updateProfileUsaha',
			type: 'POST',
			dataType: 'JSON',
			headers: {
				'token-id': token
			},
			data: {
				company: businessName,
				jenis_usaha: businessType,
				iumkm: businessNumber,
				alamat_usaha: businessAddress
			},
			success: function(result) {
				if(result.status == true) {
					$('#alert').show()
					$('#alert').html('Profil usaha berhasil disimpan.')
					$('html, body').scrollTop(0)
					setTimeout(function(){
						$('#alert').hide()
					},3000)
					$('#loading').hide()
					$('#submit').attr('disabled',false)
				}
			}
		})
	} else {
		$('#loading').hide()
		$('#submit').attr('disabled',false)
	}
})