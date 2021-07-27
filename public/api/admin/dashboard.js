// Gender
$.ajax({
    url: `${api_chart}Fe3Peesh`,
    type: "GET",
    dataType: "JSON",
    headers: {
        'token-id': token
    },
    success: function(result) {
        // console.log(result)
        let labels = ['Tidak diketahui', 'Laki-Laki', 'Perempuan']
        let data = []
        $.each(result.data, function(index, value) {
            data.push(convertToNumber(value.value.toString()))
            append = `<tr>
            	<td>${labels[index]}</td>
            	<td class="px-2">:</td>
            	<td><b>${convertToNumber(value.value.toString())}</b></td>
            </tr>`
            $('#gender').append(append)
        })
        var ctx = document.getElementById('chartGender').getContext('2d')
        var chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total',
                    data: data,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ]
                }]
            },
            options: {}
        })
    }
})

// Religion
$.ajax({
    url: `${api_chart}Iel9aNah`,
    type: "GET",
    dataType: "JSON",
    headers: {
        'token-id': token
    },
    success: function(result) {
        // console.log(result)
        let labels = []
        let data = []
        $.each(result.data, function(index, value) {
            labels.push(value.id)
            data.push(convertToNumber(value.value.toString()))
            append = `<tr>
            	<td>${labels[index]}</td>
            	<td class="px-2">:</td>
            	<td><b>${convertToNumber(value.value.toString())}</b></td>
        	</tr>`
            $('#religion').append(append)
        })
        var ctx = document.getElementById('chartReligion').getContext('2d')
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {}
        })
    }
})

// Education
$.ajax({
    url: `${api_chart}ieJ2Thei`,
    type: "GET",
    dataType: "JSON",
    headers: {
        'token-id': token
    },
    success: function(result) {
        // console.log(result)
        let labels = []
        let data = []
        $.each(result.data, function(index, value) {
            labels.push(value.id)
            data.push(convertToNumber(value.value.toString()))
            append = `<tr>
            	<td>${labels[index]}</td>
            	<td class="px-2">:</td>
            	<td><b>${convertToNumber(value.value.toString())}</b></td>
        	</tr>`
            $('#education').append(append)
        })
        var ctx = document.getElementById('chartEducation').getContext('2d')
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {}
        })
    }
})

// IUMK
$.ajax({
    url: `${api_chart}Ohjoh3eX`,
    type: "GET",
    dataType: "JSON",
    headers: {
        'token-id': token
    },
    success: function(result) {
        // console.log(result)
        let index = 0
        let labels = ['Sudah', 'Belum']
        let data = []
        $.each(result.data, function(key, value) {
            if (key != 'TOTAL') {
                data.push(convertToNumber(value.toString()))
                append = `<tr>
                	<td>${labels[index]}</td>
                	<td class="px-2">:</td>
                	<td><b>${convertToNumber(value.toString())}</b></td>
            	</tr>`
                $('#iumk').append(append)
                index++
            }
        })
        var ctx = document.getElementById('chartIUMK').getContext('2d')
        var chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total',
                    data: data,
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)'
                    ]
                }]
            },
            options: {}
        })
    }
})

// NPWP
$.ajax({
    url: `${api_chart}oPaiti3e`,
    type: "GET",
    dataType: "JSON",
    headers: {
        'token-id': token
    },
    success: function(result) {
        // console.log(result)
        let index = 0
        let labels = ['Sudah', 'Belum']
        let data = []
        $.each(result.data, function(key, value) {
            if (key != 'TOTAL') {
                data.push(convertToNumber(value.toString()))
                append = `<tr>
                	<td>${labels[index]}</td>
                	<td class="px-2">:</td>
                	<td><b>${convertToNumber(value.toString())}</b></td>
            	</tr>`
                $('#npwp').append(append)
                index++
            }
        })
        var ctx = document.getElementById('chartNPWP').getContext('2d')
        var chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total',
                    data: data,
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)'
                    ]
                }]
            },
            options: {}
        })
    }
})

// Koperasi
$.ajax({
    url: `${api_chart}Esuo6fu9`,
    type: "GET",
    dataType: "JSON",
    headers: {
        'token-id': token
    },
    success: function(result) {
        // console.log(result)
        let index = 0
        let labels = ['Sudah', 'Belum']
        let data = []
        $.each(result.data, function(key, value) {
            if (key != 'TOTAL') {
                data.push(convertToNumber(value.toString()))
                append = `<tr>
                	<td>${labels[index]}</td>
                	<td class="px-2">:</td>
                	<td><b>${convertToNumber(value.toString())}</b></td>
            	</tr>`
                $('#koperasi').append(append)
                index++
            }
        })
        var ctx = document.getElementById('chartKoperasi').getContext('2d')
        var chart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total',
                    data: data,
                    backgroundColor: [
                        'rgb(54, 162, 235)',
                        'rgb(255, 99, 132)'
                    ]
                }]
            },
            options: {}
        })
    }
})

// Asset
$.ajax({
    url: `${api_chart}it8Oa6re`,
    type: "GET",
    dataType: "JSON",
    headers: {
        'token-id': token
    },
    success: function(result) {
        // console.log(result)
        let labels = ['< 1 Miliar', '1 Miliar - 5 Miliar', '5 Miliar - 10 Miliar']
        let data = []
        data.push(convertToNumber(result.data.MIKRO.toString()))
        data.push(convertToNumber(result.data.KECIL.toString()))
        data.push(convertToNumber(result.data.MENENGAH.toString()))
        for (let index = 0; index < 3; index++) {
            append = `<tr>
            	<td>${labels[index]}</td>
            	<td class="px-2">:</td>
            	<td><b>${convertToNumber(data[index].toString())}</b></td>
        	</tr>`
            $('#asset').append(append)
        }
        var ctx = document.getElementById('chartAsset').getContext('2d')
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {}
        })
    }
})

// Province
$.ajax({
    url: `${api_chart}Zae5ohka`,
    type: "GET",
    dataType: "JSON",
    headers: {
        'token-id': token
    },
    success: function(result) {
        // console.log(result)
        $.each(result.data, function(index, value) {
            append = `<tr>
            	<td>${value.id}</td>
            	<td class="text-right">${convertToNumber(value.value.toString())}</td>
        	</tr>`
            $('#table-province').append(append)
        })
        $('#loading-province').remove()
    }
})

// Bidang Usaha
$.ajax({
    url: `${api_chart}Zieria2i`,
    type: "GET",
    dataType: "JSON",
    headers: {
        'token-id': token
    },
    success: function(result) {
        // console.log(result)
        $.each(result.data, function(index, value) {
            append = `<tr>
            	<td>${value.id}</td>
            	<td class="text-right">${convertToNumber(value.value.toString())}</td>
        	</tr>`
            $('#table-bidang-usaha').append(append)
        })
        $('#loading-bidang-usaha').remove()
    }
})