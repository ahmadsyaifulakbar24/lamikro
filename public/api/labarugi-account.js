if(localStorage.getItem('tokenLabaRugi') == null) {
	$(location).attr('href','/app/laporan-laba-rugi')
} else {
	let url = api_url+'labaRugiAccount/'+acc_code+'/'
	if(date.length == 4) {
		url += date
	}
	else if(date.length == 6) {
		let y = date.substr(0,4)
		let m = date.substr(4,2)
		url += y+'/'+m
	}
	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'JSON',
		headers: {
			'token-id': token
		},
		success: function(result) {
			let acc_name = ''
			let append = ''
			let debit = 0
			let kredit = 0
			let d, m, y
			$.each(result.accountname, function(index, value) {
				if(acc_code == value.id) {
					acc_name = value.acc_name
				}
			})
			$.each(result.journalReport, function(index, value) {
				d = value.tanggal.substr(8,2)
				m = value.tanggal.substr(5,2)
				y = value.tanggal.substr(0,4)
				if(value.amount.substr(0,1) != '-') {
					debit = value.amount
				} else {
					if(value.amount.substr(0,1) == '-') {
						kredit = value.amount.substr(1)
					} else {
						kredit = value.amount
					}
				}
				append +=
				`<tr>
					<td><a href="../../transno/`+value.transno+`" class="text-danger">`+d+`/`+m+`/`+y+`</a></td>
					<td class="debit text-right">`+convertToNumber(String(debit))+`</td>
					<td class="kredit text-right">`+convertToNumber(String(kredit))+`</td>
					<td>`+Base64.decode(value.narative)+`</td>
				</tr>`
				debit = 0
				kredit = 0
			})
			$('#journalReport').append(append)

			$('title').prepend(acc_name)
			$('.acc_name').html(acc_name)

			let totalDebit = 0
			$('.debit').each(function(i, obj) {
				totalDebit += convertToAngka($(obj).html())
			})

			let totalKredit = 0
			$('.kredit').each(function(i, obj) {
				totalKredit -= convertToAngka($(obj).html())
			})

			let totalDebitKredit = totalDebit + totalKredit
			let appendTotal = 
			`<tr>
				<td><h6>Total</h6></td>
				<td class="text-right"><h6>`+convertToRupiah(String(totalDebit))+`</h6></td>
				<td class="text-right"><h6>`+convertToRupiah(String(totalKredit))+`</h6></td>
				<td></td>
			</tr>`
			$('#journalReport').append(appendTotal)
		}
	})
}