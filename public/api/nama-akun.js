$.ajax({
	url: api_url+'metadata/accountname',
	type: 'GET',
	dataType: 'JSON',
	headers: {
		'token-id': token
	},
	success: function(value) {
		$('#table-nama-akun').html('')
		let append = ''
		$.each(value, function(index, value){
			append += 
			`<tr>
				<td>`+value.acc_code+`</td>
				<td>`+value.acc_name+`</td>
				<td>`+value.acc_group_name+`</td>
				<td>`+value.section_name+`</td>
			</tr>`
		})
		$('#table-nama-akun').append(append)
	}
})