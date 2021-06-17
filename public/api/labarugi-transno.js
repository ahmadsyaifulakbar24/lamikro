if(localStorage.getItem('tokenLabaRugi') == null) {
	$(location).attr('href','app/laporan-laba-rugi')
} else {
	$.ajax({
		url: api_url+'neracaAccountTransno/'+transno,
		type: 'GET',
		dataType: 'JSON',
		headers: {
			'token-id': token
		},
		success: function(result) {
			let date = ''
			let append = ''
			let debit = 0
			let kredit = 0
			let d, m, y
			$.each(result.dataJournalEntry, function(index, value) {
				d = value.tanggal.substr(8,2)
				m = value.tanggal.substr(5,2)
				y = value.tanggal.substr(0,4)
				date = d+'/'+m+'/'+y
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
					<td>`+value.acc_name+`</td>
					<td class="text-right">`+d+`/`+m+`/`+y+`</td>
					<td class="debit text-right">`+convertToNumber(String(debit))+`</td>
					<td class="kredit text-right">`+convertToNumber(String(kredit))+`</td>
					<td>`+Base64.decode(value.narative)+`</td>
				</tr>`
				debit = 0
				kredit = 0
			})
			$('#dataJournalEntry').prepend(append)

			let totalDebit = 0
			$('.debit').each(function(i, obj) {
				totalDebit += convertToAngka($(obj).html())
			})

			let totalKredit = 0
			$('.kredit').each(function(i, obj) {
				totalKredit -= convertToAngka($(obj).html())
			})

			$('title').prepend(date)
			$('.date').html(date)
			$('#totalDebit').html(convertToRupiah(String(totalDebit)))
			$('#totalKredit').html(convertToRupiah(String(totalKredit)))
		}
	})
}