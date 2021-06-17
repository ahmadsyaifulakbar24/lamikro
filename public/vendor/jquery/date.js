function tanggal(date) {
	var day = []
	day[0] = 'Min'
	day[1] = 'Sen'
	day[2] = 'Sel'
	day[3] = 'Rab'
	day[4] = 'Kam'
	day[5] = 'Jum'
	day[6] = 'Sab'

	var month = []
	month['01'] = 'Jan'
	month['02'] = 'Feb'
	month['03'] = 'Mar'
	month['04'] = 'Apr'
	month['05'] = 'Mei'
	month['06'] = 'Jun'
	month['07'] = 'Jul'
	month['08'] = 'Agu'
	month['09'] = 'Sep'
	month['10'] = 'Okt'
	month['11'] = 'Nov'
	month['12'] = 'Des'

	var tgl = date.substr(8, 2)
	var bln = date.substr(5, 2)
	var thn = date.substr(0, 4)
	
	var hari = day[new Date(thn+'-'+bln+'-'+tgl).getDay()]
	var bulan = month[bln]
	var tanggal = tgl+' '+bulan+' '+thn
	// var tanggal = hari+', '+tgl+' '+bulan+' '+thn

	return(tanggal)
}

const monthNames = [
	"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
]

function bulan(m) {
	var month = []
	month['01'] = 'Januari'
	month['02'] = 'Februari'
	month['03'] = 'Maret'
	month['04'] = 'April'
	month['05'] = 'Mei'
	month['06'] = 'Juni'
	month['07'] = 'Juli'
	month['08'] = 'Agustus'
	month['09'] = 'September'
	month['10'] = 'Oktober'
	month['11'] = 'November'
	month['12'] = 'Desember'
	return month[m]
}