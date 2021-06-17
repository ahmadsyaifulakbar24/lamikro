$(document).ready(function(){
	$('#jurnalDate').val(dateNow())
})

$.ajax({
	url: api_url+'transType',
	type: 'GET',
	dataType: 'JSON',
	headers: {
		'token-id': token
	},
	success: function(result) {
		let append = ''
		$.each(result, function(index, value){ 
			append += `<option value="`+value.id+`">`+value.parameter+`</option>`
		})
		$('#jurnalType').append(append)
	}
})

$('#jurnalType').change(function(){
	let jurnalType = $(this).val()
	$('#kredit').html('<option disabled selected>Pilih</option>')
	$('#debit').html('<option disabled selected>Pilih</option>')
	$('#kredit').attr('disabled',true)
	$('#debit').attr('disabled',true)
	$.ajax({
		url: api_url+'kreditDebitAccountCombo/'+jurnalType,
		type: 'GET',
		dataType: 'JSON',
		headers: {
			'token-id': token
		},
		success: function(result) {
			$('#kredit-label').html(result.label.kredit)
			$('#debit-label').html(result.label.debit)
			$('#kredit').attr('disabled',false)
			$('#debit').attr('disabled',false)

			let appendKredit = ''
			$.each(result.data.kredit, function(index, value){
				appendKredit += `<option value="`+value.id+`">`+value.acc_code+` - `+value.acc_name+`</option>`
			})
			$('#kredit').append(appendKredit)

			let appendDebit = ''
			$.each(result.data.debit, function(index, value){
				appendDebit += `<option value="`+value.id+`">`+value.acc_code+` - `+value.acc_name+`</option>`
			})
			$('#debit').append(appendDebit)
		}
	})
})

$('#form').submit(function(e){
	e.preventDefault()
	validateJurnalDate()
	validateJurnalType()
	validateKredit()
	validateDebit()
	validateJurnalNominal()

	$('#loading').show()
	$('#submit').attr('disabled',true)
	let jurnalDate = $('#jurnalDate').val()
	let jurnalType = $('#jurnalType').val()
	let kredit = $('#kredit').val()
	let debit = $('#debit').val()
	let jurnalNominal = convertToAngka($('#jurnalNominal').val())
	let jurnalDescription = $('#jurnalDescription').val()

	if(sjurnalDate == true && sjurnalType == true && skredit == true && sdebit == true && sjurnalNominal == true) {
		$.ajax({
			url: api_url+'jurnalEntry',
			type: 'POST',
			dataType: 'JSON',
			headers: {
				'token-id': token
			},
			data: {
				acc_code: jurnalType,
				trandate: jurnalDate,
				credit: kredit,
				debit: debit,
				amount: jurnalNominal,
				narative: jurnalDescription
			},
			success: function(result) {
				$('#jurnalDate').val(dateNow())
				$('#jurnalType option:first').prop('selected',true);
				$('#kredit').html('<option disabled selected>Pilih</option>')
				$('#debit').html('<option disabled selected>Pilih</option>')
				$('#jurnalNominal').val('')
				$('#jurnalDescription').val('')
				
				$('#alert').show()
				$('html, body').scrollTop(0)
				setTimeout(function(){
					$('#alert').hide()
				},3000)
			},
			complete: function() {
				$('#loading').hide()
				$('#submit').attr('disabled',false)
			}
		})
	} else {
		$('#loading').hide()
		$('#submit').attr('disabled',false)
	}
})