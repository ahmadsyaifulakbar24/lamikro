const token = localStorage.getItem('token')

function clearLocalStorage() {
	$.ajax({
        url: `${root}session/logout`,
        type: 'GET',
        success: function() {
            localStorage.clear()
            window.location.href = `${root}app`
        }
    })
}

if (localStorage.getItem('token') != null) {
    $.ajax({
        url: `${api_url}metadata/userdata`,
        type: 'GET',
        dataType: 'JSON',
        headers: {
            'token-id': token
        },
        success: function(result) {
            if (result.status != false) {
                let avatar = 'https://lamikro.com/e_gl/api/logo/' + result.avatar
                if (result.avatar == '' || result.avatar == null) {
                    avatar = 'https://lamikro.com/public/images/store/business.svg'
                }
                $('.profile-img').attr('src', avatar)
                $('#accountName').html(result.name)
                $('#accountEmail').html(result.email)
                $('#accountCompany').html(result.company)
            } else {
                clearLocalStorage()
            }
        }
    })
}

$('#logout').click(function() {
    $.ajax({
        url: `${api_url}logout`,
        type: 'GET',
        headers: {
            'token-id': token
        },
        success: function(result) {
            clearLocalStorage()
        }
    })
})