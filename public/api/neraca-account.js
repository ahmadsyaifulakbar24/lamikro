if(localStorage.getItem('tokenNeraca') == null) {
	$(location).attr('href','/app/laporan-posisi-keuangan')
} else {
	let url = api_url+'neracaAccount/'+acc_code+'/'
	if(date.length == 4) {
		url += date
	}
	else if(date.length == 6) {
		let y = date.substr(0,4)
		let m = date.substr(4,2)
		url += y+m
	}
	$.ajax({
		url: url,
		type: 'GET',
		dataType: 'JSON',
		headers: {
			'token-id': token
		},
		success: function(result) {
			let saldoAwal = 0
			$.each(result.dataFwdBalance.data, function(index, value) {
				saldoAwal += parseInt(value.amount)
			})

			$('title').prepend(result.accountname.acc_name)
			$('.acc_name').html(result.accountname.acc_name)

			if(String(saldoAwal).substr(0,1) != '-') {
				$('#saldoAwalDebit').html(convertToNumber(String(saldoAwal)))
			} else {
				if(result.accountname.acc_code == '3500') {
					$('#saldoAwalDebit').html(convertToNumber(String(saldoAwal).substr(1)))
				} else {
					$('#saldoAwalKredit').html(convertToNumber(String(saldoAwal).substr(1)))
				}
			}

			let append = ''
			let debit = 0
			let kredit = 0
			let d, m, y
			$.each(result.dataJournalEntry, function(index, value) {
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
			$('#dataJournalEntry').append(append)

			let totalDebit = 0
			$('.debit').each(function(i, obj) {
				totalDebit += convertToAngka($(obj).html())
			})

			let totalKredit = 0
			$('.kredit').each(function(i, obj) {
				totalKredit -= convertToAngka($(obj).html())
			})

			let totalDebitKredit = totalDebit + totalKredit
			let total = saldoAwal + totalDebitKredit
			let appendData

			let appendTotalDebit = 
			`<tr>
				<td><h6>Total</h6></td>
				<td class="text-right"><h6>`+convertToRupiah(String(total))+`</h6></td>
				<td colspan="2"></td>
			</tr>`

			let appendTotalKredit = 
			`<tr>
				<td colspan="2"><h6>Total</h6></td>
				<td class="text-right"><h6>`+convertToRupiah(String(total))+`</h6></td>
				<td></td>
			</tr>`

			if (result.accountname.section_id == '202') {
				if (total.toString().substr(0, 1) == '-') {
					appendData = appendTotalKredit
	            } else {
					appendData = appendTotalDebit
		        }
				// if (result.accountname.group_id == '7') {
				// 	appendData = appendTotalKredit
				// } else {
				// 	appendData = appendTotalDebit
				// }
			} else {
				// if(result.accountname.acc_code == '3300') { // Hanya PRIVE
				if (result.accountname.acc_code == '3300' || result.accountname.acc_code == '3500') { // PRIVE dan LABA
					appendData = appendTotalDebit
				} else {
					appendData = appendTotalKredit
				}
			}
			$('#dataJournalEntry').append(appendData)
		}
	})
}