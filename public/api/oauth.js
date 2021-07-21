$('#form').submit(function(e) {
    e.preventDefault()
    $('#submit').attr('disabled', true)
    $('#text').hide()
    $('#loading').show()
    $('#username').removeClass('is-invalid')
    $('#feedback').hide()

    let username = $('#username').val()
    let password = $('#password').val()

    $.ajax({
        url: api_url + 'oauth',
        type: 'POST',
        dataType: 'JSON',
        data: {
            username: username,
            password: password
        },
        success: function(result) {
            let status = result.status
            let token = result.message
            if (status == true) {
                $.ajax({
                    url: api_url + 'metadata/userdata',
                    type: 'GET',
                    dataType: 'JSON',
                    headers: {
                        'token-id': token
                    },
                    success: function(result) {
                        // console.log(result)
                        localStorage.setItem('token', token)
                        let role = result.ref_group_user
                        let value = result
                        $.ajax({
                            url: root + 'session/oauth',
                            type: 'GET',
                            data: {
                                token: token,
                                role: role
                            },
                            success: function(result) {
                                if (role == 'J1') {
                                    location.href = root + 'app/admin'
                                } else {
                                    if (value.tmp_lahir == '' || value.enum_religi == null || value.enum_edu == null || value.enum_prov == null || value.enum_city == null) {
                                        location.href = root + 'app/profil'
                                    } else if (value.enum_sektor == null || value.enum_bidang == null || value.tgl_b_us == '0000-00-00' || value.npwp_usaha == '') {
                                        location.href = root + 'app/profil-usaha'
                                    } else {
                                        location.href = root + 'app/dashboard'
                                    }
                                }
                            }
                        })
                    }
                })
            } else {
                $('#submit').attr('disabled', false)
                $('#password').val('')
                $('#username').focus()
                $('#username').addClass('is-invalid')
                $('#feedback').show()
                $('#text').show()
                $('#loading').hide()
            }
        }
    })
})