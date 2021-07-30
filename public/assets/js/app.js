const token = localStorage.getItem('token')

if (localStorage.getItem('token') != null) {
    $.ajax({
        url: `${api_url}metadata/userdata`,
        type: 'GET',
        dataType: 'JSON',
        headers: {
            'token-id': token
        },
        success: function(result) {
        	// console.log(result)
            if (result.status != false) {
            	let avatar = `${root_api}e_gl/api/logo/${result.avatar}`
                if (result.avatar == '' || result.avatar == null) {
                	if (result.ref_group_user == 'J1') {
	                	avatar = `${root_api}public/images/logo/garuda.png`
	                } else {
	                	avatar = `${root_api}public/images/store/business.svg`
	                }
                }
                $('.profile-img').attr('src', avatar)
                $('#accountName').html(result.name)
                $('#accountEmail').html(result.email)
                $('#accountCompany').html(result.company)
            } else {
            	logout()
                // clearLocalStorage()
            }
        }
    })
}

function logout() {
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
}

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

function delay(fn, ms) {
    let timer = 0
    return function(...args) {
        clearTimeout(timer)
        timer = setTimeout(fn.bind(this, ...args), ms || 0)
    }
}

function formatNpwp(value) {
    value = value.replace(/[A-Za-z\W\s_]+/g, '');
    let split = 6;
    const dots = [];

    for (let i = 0, len = value.length; i < len; i += split) {
        split = i >= 2 && i <= 6 ? 3 : i >= 8 && i <= 12 ? 4 : 2;
        dots.push(value.substr(i, split));
    }

    const temp = dots.join('.');
    return temp.length > 12 ? `${temp.substr(0, 12)}-${temp.substr(12, 7)}` : temp;
}

$(document).on('keyup', '.npwp', function() {
    let value = $(this).val()
    $(this).val(formatNpwp(value))
})

$(document).on('keyup', '.number', function() {
    let value = $(this).val()
    $(this).val(convert(value))
})
