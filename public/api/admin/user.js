let currentPage = 1
let currentSearch = ''
let statusSearch = false

function get_data(query, page) {
    $('#empty').hide()
    $('#loading').show()
    $('#table-pengguna').html('')
    $.ajax({
        url: `${api_kitchensink}namuV3ey/all`,
        type: 'POST',
        dataType: 'JSON',
        headers: {
            'token-id': token
        },
        data: {
            query: query,
            page: page,
            limitPage: 30
        },
        success: function(result) {
            // console.log(result)
            if (result.results != 0) {
                currentPage = parseInt(page)
                let from = (parseInt(page) * 30) - 30
                $.each(result.data, function(index, value) {
                    append = `<tr data-id="${value._id}" data-name="${value.name}">
		            	<td class="text-center">${from + 1}.</td>
		            	<td><a href="${root}app/management-pengguna/${value._id}" class="text-danger">${value.name}</a></td>
		            	<td>${value.no_ktp}</td>
		            	<td>${value.username}</td>
		            	<td>${value.email}</td>
		            	<td>${value.phone_number}</td>
		            	<td>${value.company}</td>
		            	<td><i class="mdi mdi-2x mdi-trash-can-outline pointer delete"></i></td>
		            </tr>`
                    $('#table-pengguna').append(append)
                    from++
                })
                if (page == 1) {
                    $('#next').attr('data-page', (parseInt(page) + 1))
                    $('#prev').addClass('disabled')
                    $('#next').removeClass('disabled')
                } else {
                    $('#prev').attr('data-page', (parseInt(page) - 1))
                    $('#next').attr('data-page', (parseInt(page) + 1))
                    $('#prev').removeClass('disabled')
                    $('#next').removeClass('disabled')
                }
                if (page == '1') {
	                if (from >= (parseInt(page) * 30)) {
		                $('#pagination').show()
	                } else {
		                $('#pagination').hide()
	                }
	            }
            } else {
                $('#empty').show()
                if (page == 1) {
                    if (query.length > 0) {
                        $('#pagination').hide()
                        $('#empty').html('Hasil pencarian "<b>' + query + '</b>" tidak ditemukan.')
                    } else {
                        $('#pagination').hide()
                        $('#empty').html('Belum ada Daftar Jurnal.')
                    }
                } else {
                    $('#pagination').show()
                    $('#empty').html('Data telah mencapai batas total.')
                }
                $('#prev').attr('data-page', (parseInt(page) - 1))
                $('#prev').removeClass('disabled')
                $('#next').addClass('disabled')
            }
            $('#loading').hide()
        }
    })
}

get_data(currentSearch, 1)

$('.page-item').click(function() {
    if (!$(this).hasClass('disabled')) {
        let page = $(this).attr('data-page')
        get_data(currentSearch, page)
        $('html, body').scrollTop(0)
    }
})

$('#search').keyup(function(e) {
    if (e.which <= 90 && e.which >= 48 || e.which >= 96 && e.which <= 105 || e.which == 8) {
        $('#empty').hide()
        $('#loading').show()
        $('#table-pengguna').html('')
        $('#pagination').hide()
    }
})
$('#search').keyup(delay(function(e) {
    if (e.which <= 90 && e.which >= 48 || e.which >= 96 && e.which <= 105 || e.which == 8) {
        let val = $(this).val()
        if (val.length == 0 && statusSearch == true) {
            currentSearch = ''
            get_data(currentSearch, 1)
            statusSearch = false
        } else {
            statusSearch = true
            currentSearch = val
            get_data(currentSearch, 1)
        }
    }
}, 1000))

$(document).on('click', '.delete', function() {
    let id = $(this).closest('tr').attr('data-id')
    let name = $(this).closest('tr').attr('data-name')
    $('#modal-delete').modal('show')
    $('#delete').attr('data-id', id)
    $('#name').html(name)
})

$('#delete').click(function() {
    let id = $(this).attr('data-id')
    $(this).attr('disabled', true)
    $.ajax({
        url: `${api_kitchensink}namuV3ey/d/${id}`,
        type: 'POST',
        dataType: 'JSON',
        headers: {
            'token-id': token
        },
        success: function(result) {
            get_data(currentSearch, 1)
            $('#modal-delete').modal('hide')
        },
        complete: function() {
            $('#delete').attr('disabled', false)
        }
    })
})