<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Download Laporan Posisi Keuangan</title>
    <link rel="stylesheet" href="{{asset('assets/css/shared/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/light/style.css')}}">
	<link rel="shortcut icon" href="{{asset('images/logo/logo.ico')}}">
	<style type="text/css">
		.small {
			font-size: 10px !important;
		}
	</style>
</head>
<body>
	<img src="{{asset('images/logo/logo.jpg')}}" width="150" style="padding-top:10px">
	<img src="{{asset('images/logo/qrcode.png')}}" width="50" style="float:right">
	<hr style="margin-top:20px;border-top:2px solid #d82027;border-bottom:none">
	<div style="text-align:center">
		<h4 style="text-transform:uppercase;padding-bottom:10px">Laporan Posisi Keuangan</h4>
		<span class="font-weight-bold" id="companyName"></span><br>
		<span class="font-weight-bold" id="companyAddress"></span><br>
		<span class="font-weight-bold" id="companyNumber">NPWP : </span><br>
		<span class="font-weight-bold" id="periode">Periode : </span><br>
	</div>
	<div id="accountSection202"></div>
	<hr style="margin-top:70px;border-top:2px solid #d82027;border-bottom:none">
	<p class="small font-weight-bold">"sistem aplikasi ini sudah sesuai dengan SAK EMKM"</p>
	<p class="small font-weight-bold">Copyright © 2021. Biro Komunikasi dan Teknologi Informasi - Kementerian KUKM RI</p>
	<p class="small font-weight-bold">Versi 3.1</p><br>

	<img src="{{asset('images/logo/logo.jpg')}}" width="150" style="padding-top:30px">
	<img src="{{asset('images/logo/qrcode.png')}}" width="50" style="float:right;padding-top:30px">
	<hr style="margin-top:20px;border-top:2px solid #d82027;border-bottom:none">

	<div class="mt-4" id="accountSection203"></div>
	<hr style="margin-top:320px;border-top:2px solid #d82027;border-bottom:none">
	<p class="small font-weight-bold">"sistem aplikasi ini sudah sesuai dengan SAK EMKM"</p>
	<p class="small font-weight-bold">Copyright © 2021. Biro Komunikasi dan Teknologi Informasi - Kementerian KUKM RI</p>
	<p class="small font-weight-bold">Versi 3.1</p>
	
	@include('app.partials.footer')
	<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('vendor/jquery/number.js')}}"></script>
	<script src="{{asset('vendor/jquery/date.js')}}"></script>
	<script>
		const date = '{{Request::route("date")}}'
		$.ajax({
	        url: `${api_url}metadata/userdata`,
	        type: 'GET',
	        dataType: 'JSON',
	        headers: {
	            'token-id': token
	        },
	        success: function(result) {
				// console.log(result)
				let alamat_usaha = result.alamat_usaha
				let npwp = result.npwp
				if(alamat_usaha.length >= 80) {
					alamat_usaha = alamat_usaha.substr(0,80)+'...'
				}
				if(npwp == '' || npwp == null || npwp == '-') {
					npwp = 'belum ada'
				}
				$('#companyName').html(result.company)
				$('#companyAddress').append(alamat_usaha)
				$('#companyNumber').append(npwp)
				$('#periode').append(bulan(date.substr(4,2))+' '+date.substr(0,4))
			}
		})
		$.ajax({
			url: `${api_url}neraca/${date}`,
			type: 'GET',
			dataType: 'JSON',
			headers: {
				'token-id': token
			},
			success: function(result) {
				// console.log(result)
				let neracaSection = []
				$.each(result.accountSection, function(index, value){
					neracaSection[index] = {
						id: value.id,
						total: 0
					}
				})
				let neracaGroup = []
				$.each(result.accountGroup, function(index, value){
					neracaGroup[index] = {
						id: value.id,
						total: 0
					}
				})
				let neracaAccount = []
				$.each(result.accountname, function(index, value){
					neracaAccount[index] = {
						id: value.acc_code,
						total: 0
					}
				})
				let neracaLaba = 0
				$.each(result.labaDiTahan.data, function(index, value){
					neracaLaba += parseInt(value.amount)
				})

				$.each(result.journalReport.data, function(index, value){
					// TOTAL SECTION
					sectionIndex = neracaSection.findIndex((obj => obj.id == value.section_id))
					neracaSection[sectionIndex].total += parseInt(value.amount)
					
					// TOTAL GROUP
					groupIndex = neracaGroup.findIndex((obj => obj.id == value.group_id))
					neracaGroup[groupIndex].total += parseInt(value.amount)

					// AMOUNT
					accountIndex = neracaAccount.findIndex((obj => obj.id == value.acc_code))
					neracaAccount[accountIndex].total += parseInt(value.amount)
				})
				
				// SALDO LABA (DEFISIT)
				sectionIndex = neracaSection.findIndex((obj => obj.id == '203'))
				neracaSection[sectionIndex].total += parseInt(neracaLaba)

				groupIndex = neracaGroup.findIndex((obj => obj.id == '6'))
				neracaGroup[groupIndex].total += parseInt(neracaLaba)

				// ACCOUNT SECTION
				let accountSection = ''
				$.each(result.accountSection, function(index, value){
					accountSection =
	                `<h5>`+value.parameter+`</h5>
	                <div id="accountGroup`+value.id+`"></div>`
					$('#accountSection'+value.id).prepend(accountSection)
				})

				// ACCOUNT GROUP
				let accountGroup = ''
				$.each(result.accountGroup, function(index, value){
					accountGroup =
					`<p class="font-weight-bold py-2">`+value.acc_group_name+`</p>
		            <table style="width:100%">
	                    <thead>
	                        <tr>
	                            <th class="font-weight-bold">Kode</th>
	                            <th class="font-weight-bold" width="500">Nama Akun</th>
	                            <th class="font-weight-bold text-right">Nilai</th>
	                        </tr>
	                    </thead>
	                    <tbody id="accountName`+value.id+`"></tbody>
	                </table>`
					$('#accountGroup'+value.section_id).append(accountGroup)
				})

				// ACCOUNT NAME
				let accountName = ''
				$.each(result.accountname, function(index, value){
					accountName =
					`<tr>
			            <td>`+value.acc_code+`</td>
			            <td>`+value.acc_name+`</td>
			            <td class="text-right" id="amount`+value.acc_code+`">0</td>
			        </tr>`
					$('#accountName'+value.group_id).append(accountName)
				})

				let totalAccountGroup = ''
				$.each(result.accountGroup, function(index, value){
					totalAccountGroup =
					`<tr>
			            <td colspan="2" class="font-weight-bold text-right pr-5">Total `+value.acc_group_name+`</td>
			            <td class="font-weight-bold text-right" id="totalGroup`+value.id+`">0</td>
			        </tr>`
					if(value.id == '6' || value.id == '7') {
						let accountGroupName = 'Liabilitas & Ekuitas'
						if (value.id == '7') {
							accountGroupName = value.section_name
						}
						totalAccountGroup +=
						`<tr class="text-right">
				            <td colspan="2" class="font-weight-bold text-right pr-5">Total `+accountGroupName+`</td>
				            <td class="font-weight-bold text-right" id="totalSection`+value.section_id+`">0</td>
				        </tr>`
					}
					$('#accountName'+value.id).append(totalAccountGroup)
				})

				// Total Section
				$.each(result.accountSection, function(index, value){
					sectionIndex = neracaSection.findIndex((obj => obj.id == value.id))
					$('#totalSection'+value.id).html(convertToRupiah(String(neracaSection[sectionIndex].total)))
				})

				// Total Group
				$.each(result.accountGroup, function(index, value){
					groupIndex = neracaGroup.findIndex((obj => obj.id == value.id))
					$('#totalGroup'+value.id).html(convertToRupiah(String(neracaGroup[groupIndex].total)))
				})
				
				// Total Account
				$.each(result.accountname, function(index, value){
					accountIndex = neracaAccount.findIndex((obj => obj.id == value.acc_code))
					if(value.acc_code != '3500') {
						$('#amount'+value.acc_code).html(convertToNumber(String(neracaAccount[accountIndex].total)))
					} else {
						$('#amount3500').html(convertToNumber(String(neracaLaba)))
					}
				})
			}
		})
	</script>
</body>
</html>