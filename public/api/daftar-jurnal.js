let currentPage = 1
let currentSearch = ''
function jurnalList(query, page) {
	$('#empty').hide()
	$('#loading').show()
	$('#table-daftar-jurnal').html('')
	$.ajax({
		url: api_url+'jurnalList',
		type: 'POST',
		dataType: 'JSON',
		headers: {
			'token-id': token
		},
		data: {
			query: query,
			page: page,
			limitPage: 20
		},
		success: function(result) {
			currentPage = page
			$('#table-daftar-jurnal').html('')
			let append = ''
			if(result.results != 0) {
				$.each(result.data, function(index, value){
					append += 
					`<tr data-id="`+value.id+`" data-name="`+value.trans_cat_desc+`">
						<td>`+value.trans_cat_desc+`</td>
						<td>`+value.account_desc+`</td>
						<td class="text-right">`+convertToNumber(value.amount)+`</td>
						<td>`+Base64.decode(value.narative)+`</td>
						<td>`+tanggal(value.trandate)+`</td>
						<th><i class="mdi mdi-2x mdi-trash-can-outline single pointer" data-toggle="modal" data-target="#modalJurnal"></i></th>
					</tr>`
				})
				if(page == 1) {
					$('#next').data('page',page+1)
					$('#prev').addClass('disabled')
					$('#next').removeClass('disabled')
				} else {
					$('#prev').data('page',page-1)
					$('#next').data('page',page+1)
					$('#prev').removeClass('disabled')
					$('#next').removeClass('disabled')
				}
				$('#pagination').show()
			} else {
				$('#empty').show()
				if(page == 1) {
					if(query.length > 0) {
						$('#pagination').hide()
						$('#empty').html('Hasil pencarian "<b>'+query+'</b>" tidak ditemukan.')
					} else {
						$('#pagination').hide()
						$('#empty').html('Belum ada Daftar Jurnal.')
					}
				} else {
					$('#pagination').show()
					$('#empty').html('Data telah mencapai batas total.')
				}
				$('#prev').data('page',page-1)
				$('#prev').removeClass('disabled')
				$('#next').addClass('disabled')
			}
			$('#table-daftar-jurnal').append(append)
		},
		complete: function() {
			$('#loading').hide()
		}
	})
}

jurnalList(currentSearch,1)

let statusSearch = false
$('#form-search').submit(function(e){
	e.preventDefault()
	statusSearch = true
	let search = $('#search').val()
	currentSearch = search
	jurnalList(currentSearch,1)
})
$('#search').keyup(function(){
	let val = $(this).val()
	if(val.length == 0 && statusSearch == true) {
		currentSearch = ''
		jurnalList(currentSearch,1)
		statusSearch = false
	}
})

$('.page-item').click(function(){
	if(!$(this).hasClass('disabled')) {
		let page = $(this).data('page')
		jurnalList(currentSearch,page)
		$('html, body').scrollTop(0)
	}
})