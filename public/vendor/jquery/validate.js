function formatNPWP(value) {
		if (typeof value === 'string') {
			return value.replace(/(\d{2})(\d{3})(\d{3})(\d{1})(\d{3})(\d{3})/, '$1.$2.$3.$4-$5.$6');
		}
	}
function validateName() {
	let name = $('#name').val()
	window.sname = false
	if(name == '' || name == null) {
		$('#name').addClass('is-invalid')
		$('#name-feedback').html('Masukkan nama lengkap.')
	}
	else if (!/^[a-z A-Z]*$/g.test(name)) {
		$('#name').addClass('is-invalid')
		$('#name-feedback').html('Masukkan nama lengkap dengan benar.')
	}
	else {
		$('#name').removeClass('is-invalid')
		window.sname = true
	}
}
function validateUsername() {
	let username = $('#username').val()
	window.susername = false
	if(username == '' || username == null) {
		$('#username').addClass('is-invalid')
		$('#username-feedback').html('Masukkan nama akun.')
	}
	else if (!/^[a-zA-Z0-9]*$/g.test(username)) {
		$('#username').addClass('is-invalid')
		$('#username-feedback').html('Masukkan nama akun dengan benar.')
	}
	else if (username.length > 30) {
		$('#username').addClass('is-invalid')
		$('#username-feedback').html('Maksimal 30 karakter.')
	}
	else {
		$('#username').removeClass('is-invalid')
		window.susername = true
	}
}
function validateEmail() {
	let email = $('#email').val()
	window.semail = false
	let r = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i
	if(email == '' || email == null) {
		$('#email').addClass('is-invalid')
		$('#email-feedback').html('Masukkan email.')
	}
	else if (!r.test(email)) {
		$('#email').addClass('is-invalid')
		$('#email-feedback').html('Masukkan email dengan benar.')
	}
	else {
		$('#email').removeClass('is-invalid')
		window.semail = true
	}
}
function validatePhone() {
	let phone = $('#phone').val()
	window.sphone = false
	if(phone == '' || phone == null) {
		$('#phone').addClass('is-invalid')
		$('#phone-feedback').html('Masukkan nomor telepon.')
	}
	else if (!/^[0-9]*$/g.test(phone)) {
		$('#phone').addClass('is-invalid')
		$('#phone-feedback').html('Masukkan nomor telepon dengan benar.')
	}
	else if (phone.length < 9) {
		$('#phone').addClass('is-invalid')
		$('#phone-feedback').html('Minimal 10 digit.')
	}
	else if (phone.length > 14) {
		$('#phone').addClass('is-invalid')
		$('#phone-feedback').html('Maksimal 15 digit.')
	}
	else {
		$('#phone').removeClass('is-invalid')
		window.sphone = true
	}
}
function validateKTP() {
	let ktp = $('#ktp').val()
	window.sktp = false
	if(ktp == '' || ktp == null) {
		$('#ktp').addClass('is-invalid')
		$('#ktp-feedback').html('Masukkan nomor KTP.')
	}
	else if (!/^[0-9]*$/g.test(ktp)) {
		$('#ktp').addClass('is-invalid')
		$('#ktp-feedback').html('Masukkan nomor KTP dengan benar.')
	}
	else if (ktp.length < 16) {
		$('#ktp').addClass('is-invalid')
		$('#ktp-feedback').html('Minimal 16 digit.')
	}
	else if (ktp.length > 16) {
		$('#ktp').addClass('is-invalid')
		$('#ktp-feedback').html('Maksimal 16 digit.')
	}
	else {
		$('#ktp').removeClass('is-invalid')
		window.sktp = true
	}
}
function validateNPWP() {
	// let npwp = $('#npwp').val().length
	// window.snpwp = false
	// if(npwp != 0) {
	// 	if(npwp < 20) {
	// 		$('#npwp').addClass('is-invalid')
	// 		$('#npwp-feedback').html('Masukkan NPWP dengan benar.')
	// 	}
	// 	else {
	// 		$('#npwp').removeClass('is-invalid')
	// 		window.snpwp = true
	// 	}
	// } else {
	// 	$('#npwp').removeClass('is-invalid')
	// 	window.snpwp = true
	// }
}
function validateDate() {
	let date = $('#date').val()
	window.sdate = true
	// if(date == '' || date == null) {
	// 	$('#date').addClass('is-invalid')
	// 	$('#date-feedback').html('Masukkan tanggal lahir.')
	// }
	// else if (date.length != 10) {
	// 	$('#date').addClass('is-invalid')
	// 	$('#date-feedback').html('Masukkan tanggal lahir dengan benar.')
	// }
	// else {
	// 	$('#date').removeClass('is-invalid')
	// 	window.sdate = true
	// }
}
function validateGender() {
	let gender = $('input[type=radio][name=gender]:checked').val()
	window.sgender = true
	// if(gender == '' || gender == undefined || gender == null) {
	// 	$('#gender-feedback').show()
	// 	$('#gender-feedback').html('Pilih jenis kelamin.')
	// }
	// else {
	// 	$('#gender-feedback').hide()
	// 	window.sgender = true
	// }
}
function validateAddress() {
	let address = $('#address').val()
	window.saddress = true
	// if(address == '' || address == null) {
	// 	$('#address').addClass('is-invalid')
	// 	$('#address-feedback').html('Masukkan alamat rumah.')
	// }
	// else {
	// 	$('#address').removeClass('is-invalid')
	// 	window.saddress = true
	// }
}
function validateCaptcha() {
	let captcha = $('#captcha').val()
	window.scaptcha = false
	if(captcha == '' || captcha == null) {
		$('#captcha').addClass('is-invalid')
		$('#captcha-feedback').html('Masukkan captcha.')
	}
	else if(captcha != window.c) {
		$('#captcha').addClass('is-invalid')
		$('#captcha-feedback').html('Captcha salah.')
	}
	else {
		$('#captcha').removeClass('is-invalid')
		window.scaptcha = true
	}
}



function validatePassword() {
	let password = $('#password').val()
	window.spassword = false
	if(password == '' || password == null) {
		$('#password').addClass('is-invalid')
		$('#password-feedback').html('Masukkan kata sandi.')
	}
	else if (password.length < 6) {
		$('#password').addClass('is-invalid')
		$('#password-feedback').html('Minimal 6 karakter.')
	}
	else {
		$('#password').removeClass('is-invalid')
		window.spassword = true
	}
}
function validateConfirmPassword() {
	let password = $('#password').val()
	let cpassword = $('#cpassword').val()
	window.scpassword = false
	if(cpassword == '' || cpassword == null) {
		$('#cpassword').addClass('is-invalid')
		$('#cpassword-feedback').html('Masukkan konfirmasi kata sandi.')
	}
	else if (cpassword.length < 6) {
		$('#cpassword').addClass('is-invalid')
		$('#cpassword-feedback').html('Minimal 6 karakter.')
	}
	else if (password != cpassword) {
		$('#cpassword').addClass('is-invalid')
		$('#cpassword-feedback').html('Kata sandi tidak sama.')
	}
	else {
		$('#cpassword').removeClass('is-invalid')
		window.scpassword = true
	}
}



function validateCurrentPassword() {
	let password = $('#password').val()
	window.spassword = false
	if(password == '' || password == null) {
		$('#password').addClass('is-invalid')
		$('#password-feedback').html('Masukkan kata sandi saat ini.')
	}
	else {
		$('#password').removeClass('is-invalid')
		window.spassword = true
	}
}
function validateNewPassword() {
	let npassword = $('#npassword').val()
	window.snpassword = false
	if(npassword == '' || npassword == null) {
		$('#npassword').addClass('is-invalid')
		$('#npassword-feedback').html('Masukkan kata sandi baru.')
	}
	else if (npassword.length < 6) {
		$('#npassword').addClass('is-invalid')
		$('#npassword-feedback').html('Minimal 6 karakter.')
	}
	else {
		$('#npassword').removeClass('is-invalid')
		window.snpassword = true
	}
}
function validateConfirmNewPassword() {
	let npassword = $('#npassword').val()
	let cpassword = $('#cpassword').val()
	window.scpassword = false
	if(cpassword == '' || cpassword == null) {
		$('#cpassword').addClass('is-invalid')
		$('#cpassword-feedback').html('Masukkan konfirmasi kata sandi.')
	}
	else if (cpassword.length < 6) {
		$('#cpassword').addClass('is-invalid')
		$('#cpassword-feedback').html('Minimal 6 karakter.')
	}
	else if (npassword != cpassword) {
		$('#cpassword').addClass('is-invalid')
		$('#cpassword-feedback').html('Kata sandi tidak sama.')
	}
	else {
		$('#cpassword').removeClass('is-invalid')
		window.scpassword = true
	}
}


function validateBusinessName() {
	let businessName = $('#businessName').val()
	window.sbusinessName = false
	if(businessName == '' || businessName == null) {
		$('#businessName').addClass('is-invalid')
		$('#businessName-feedback').html('Masukkan nama usaha.')
	}
	// else if (!/^[a-z A-Z]*$/g.test(businessName)) {
	// 	$('#businessName').addClass('is-invalid')
	// 	$('#businessName-feedback').html('Masukkan nama usaha dengan benar.')
	// }
	else {
		$('#businessName').removeClass('is-invalid')
		window.sbusinessName = true
	}
}
function validateBusinessType() {
	let businessType = $('#businessType').val()
	window.sbusinessType = false
	if(businessType == '' || businessType == null) {
		$('#businessType').addClass('is-invalid')
		$('#businessType-feedback').html('Pilih jenis usaha.')
	}
	else {
		$('#businessType').removeClass('is-invalid')
		window.sbusinessType = true
	}
}
function validateBusinessNumber() {
	let businessNumber = $('#businessNumber').val()
	window.sbusinessNumber = true
	// if(businessNumber.length > 0) {
	// 	if(businessNumber == '' || businessNumber == null) {
	// 		$('#businessNumber').addClass('is-invalid')
	// 		$('#businessNumber-feedback').html('Masukkan nomor IUMK.')
	// 	}
	// 	// else if (!/^[0-9]*$/g.test(businessNumber)) {
	// 	// 	$('#businessNumber').addClass('is-invalid')
	// 	// 	$('#businessNumber-feedback').html('Masukkan nomor IUMK dengan benar.')
	// 	// }
	// 	// else if (businessNumber.length < 30) {
	// 	// 	$('#businessNumber').addClass('is-invalid')
	// 	// 	$('#businessNumber-feedback').html('Minimal 30 digit.')
	// 	// }
	// 	// else if (businessNumber.length > 30) {
	// 	// 	$('#businessNumber').addClass('is-invalid')
	// 	// 	$('#businessNumber-feedback').html('Maksimal 30 digit.')
	// 	// }
	// 	else {
	// 		$('#businessNumber').removeClass('is-invalid')
	// 		window.sbusinessNumber = true
	// 	}
	// }
}
function validateBusinessAddress() {
	let businessAddress = $('#businessAddress').val()
	window.sbusinessAddress = false
	if(businessAddress == '' || businessAddress == null) {
		$('#businessAddress').addClass('is-invalid')
		$('#businessAddress-feedback').html('Masukkan alamat usaha.')
	}
	else {
		$('#businessAddress').removeClass('is-invalid')
		window.sbusinessAddress = true
	}
}



function validateJurnalDate() {
	let jurnalDate = $('#jurnalDate').val()
	window.sjurnalDate = false
	if(jurnalDate == '' || jurnalDate == null) {
		$('#jurnalDate').addClass('is-invalid')
		$('#jurnalDate-feedback').html('Masukkan tanggal jurnal.')
	}
	else if (jurnalDate.length != 10) {
		$('#jurnalDate').addClass('is-invalid')
		$('#jurnalDate-feedback').html('Masukkan tanggal jurnal dengan benar.')
	}
	else {
		$('#jurnalDate').removeClass('is-invalid')
		window.sjurnalDate = true
	}
}
function validateJurnalType() {
	let jurnalType = $('#jurnalType').val()
	window.sjurnalType = false
	if(jurnalType == '' || jurnalType == null) {
		$('#jurnalType').addClass('is-invalid')
		$('#jurnalType-feedback').html('Pilih jenis transaksi.')
	}
	else {
		$('#jurnalType').removeClass('is-invalid')
		window.sjurnalType = true
	}
}
function validateKredit() {
	let kredit = $('#kredit').val()
	window.skredit = false
	if(kredit == '' || kredit == null) {
		$('#kredit').addClass('is-invalid')
		$('#kredit-feedback').html('Pilih terlebih dahulu.')
	}
	else {
		$('#kredit').removeClass('is-invalid')
		window.skredit = true
	}
}
function validateDebit() {
	let debit = $('#debit').val()
	window.sdebit = false
	if(debit == '' || debit == null) {
		$('#debit').addClass('is-invalid')
		$('#debit-feedback').html('Pilih terlebih dahulu.')
	}
	else {
		$('#debit').removeClass('is-invalid')
		window.sdebit = true
	}
}
function validateJurnalNominal() {
	let jurnalNominal = $('#jurnalNominal').val()
	window.sjurnalNominal = false
	if(jurnalNominal == '' || jurnalNominal == null) {
		$('#jurnalNominal').addClass('is-invalid')
		$('#jurnalNominal-feedback').html('Masukkan nominal.')
	}
	else {
		$('#jurnalNominal').removeClass('is-invalid')
		window.sjurnalNominal = true
	}
}