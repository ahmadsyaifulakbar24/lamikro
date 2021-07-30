<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Download Laporan Laba Rugi</title>
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
		<h4 style="text-transform:uppercase;padding-bottom:10px">Laporan Laba Rugi</h4>
		<span class="font-weight-bold" id="companyName"></span><br>
		<span class="font-weight-bold" id="companyAddress"></span><br>
		<span class="font-weight-bold" id="companyNumber">NPWP Usaha : </span><br>
		<span class="font-weight-bold" id="periode">Periode : </span><br>
	</div>
	<div id="accountSection"></div>
	<hr style="margin-top:50px;border-top:2px solid #d82027;border-bottom:none">
	<p class="small font-weight-bold">"sistem aplikasi ini sudah sesuai dengan SAK EMKM"</p>
	<p class="small font-weight-bold">Copyright © 2021. Biro Komunikasi dan Teknologi Informasi - Kementerian KUKM RI</p>
	<p class="small font-weight-bold">Versi 3.1</p>
	
	@include('app.partials.footer')
	<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('vendor/jquery/number.js')}}"></script>
	<script src="{{asset('vendor/jquery/date.js')}}"></script>
	<script>
		const date = '{{Request::route("date")}}'
		let newDate = date
		if(date.length == 6) newDate = date.substr(0,4)+'/'+date.substr(4,2);
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
				$('#companyNumber').append(npwp_usaha)
				if(date.length == 6) {
					$('#periode').append(bulan(date.substr(4,2))+' '+date.substr(0,4))
				} else {
					$('#periode').append(date)
				}
			}
		})
		$.ajax({
			url: `${api_url}labaRugi/${newDate}`,
			type: 'GET',
			dataType: 'JSON',
			headers: {
				'token-id': token
			},
			success: function(result) {
				// console.log(result)
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

				$.each(result.journalReport, function(index, value){
					// TOTAL GROUP
					groupIndex = neracaGroup.findIndex((obj => obj.id == value.group_id))
					neracaGroup[groupIndex].total += parseInt(value.amount)

					// AMOUNT
					accountIndex = neracaAccount.findIndex((obj => obj.id == value.acc_code))
					neracaAccount[accountIndex].total += parseInt(value.amount)
				})

				let accountGroup = ''
				$.each(result.accountGroup, function(index, value){
					accountGroup +=
					`<div class="mt-4" id="accountSection`+value.id+`">
		                <h5 class="pb-2">`+value.section_name+`</h5>
		                <div id="accountGroup`+value.id+`">
			                <table style="width:100%">
			                    <thead>
			                        <tr>
			                            <th class="font-weight-bold">Kode</th>
			                            <th class="font-weight-bold width="500">Nama Akun</th>
			                            <th class="font-weight-bold text-right">Nilai</th>
			                        </tr>
			                    </thead>
			                    <tbody id="accountName`+value.id+`"></tbody>
			                </table>
		                </div>
		            </div>`
				})
				$('#accountSection').append(accountGroup)

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
			            <td colspan="2" class="font-weight-bold text-right">Total `+value.acc_group_name+`</td>
			            <td class="font-weight-bold text-right" id="totalGroup`+value.id+`">Rp0</td>
			        </tr>`
					if(value.id == '2') {
						totalAccountGroup +=
						`<tr class="text-right">
				            <td colspan="2"><p class="font-weight-bold">Laba (Rugi) Sebelum Pajak</p></td>
				            <td><p class="font-weight-bold text-primary" id="profitNLossBeforeTax">Rp0</p></td>
				        </tr>
				        <tr class="text-right">
				            <td colspan="2"><p class="font-weight-bold">Biaya Pajak Penghasilan</p></td>
				            <td><p class="font-weight-bold" id="profitLossPercentage">Rp0</p></td>
				        </tr>
				        <tr class="text-right">
				            <td colspan="2"><p class="font-weight-bold">Laba (Rugi) Setelah Pajak</p></td>
				            <td><p class="font-weight-bold" id="profitNLossBeforeTaxFinal">Rp0</p></td>
				        </tr>`
					}
					$('#accountName'+value.id).append(totalAccountGroup)
				})

				// Total Group
				$.each(result.accountGroup, function(index, value){
					groupIndex = neracaGroup.findIndex((obj => obj.id == value.id))
					$('#totalGroup'+value.id).html(convertToRupiah(String(neracaGroup[groupIndex].total)))
				})

				// Total Account
				$.each(result.accountname, function(index, value){
					accountIndex = neracaAccount.findIndex((obj => obj.id == value.acc_code))
					$('#amount'+value.acc_code).html(convertToNumber(String(neracaAccount[accountIndex].total)))
				})

	            let labaRugiSebelumPajak = result.profitNLossBeforeTax.toString().substr(0, 1)
	            if (labaRugiSebelumPajak == '-') {
	            	$('#profitNLossBeforeTax').addClass('text-danger')
		            $('#profitNLossBeforeTax').html(`(${convertToRupiah(String(result.profitNLossBeforeTax))})`)
	            } else {
	            	$('#profitNLossBeforeTax').addClass('text-primary')
		            $('#profitNLossBeforeTax').html(convertToRupiah(String(result.profitNLossBeforeTax)))
		        }

	            $('#profitLossPercentage').html(convertToRupiah(String(result.profitLossPercentage)))

	            let labaRugiSesudahPajak = result.profitNLossBeforeTaxFinal.toString().substr(0, 1)
	            if (labaRugiSesudahPajak == '-') {
	            	$('#profitNLossBeforeTaxFinal').addClass('text-danger')
		            $('#profitNLossBeforeTaxFinal').html(`(${convertToRupiah(String(result.profitNLossBeforeTaxFinal))})`)
	            } else {
	            	$('#profitNLossBeforeTaxFinal').addClass('text-primary')
		            $('#profitNLossBeforeTaxFinal').html(convertToRupiah(String(result.profitNLossBeforeTaxFinal)))
		        }
			},
			complete: function(){
				$('#search').attr('disabled',false)
			}
		})
	</script>
</body>
</html>