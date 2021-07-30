<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export User</title>
    <link rel="stylesheet" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
    <style>
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #fff;
        }

        .preloader .loading {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font: 14px arial;
        }
    </style>
</head>
<body>
    <div class="preloader">
        <div class="loading">
            <img src="{{ asset('images/spiner.gif') }}" width="220">
            <p>Harap Tunggu File Sedang di Proses</p>
        </div>
    </div>
    <div class="d-flex justify-content-center" style="margin-top: 200px">
        <div id="download-success" class="d-none col-lg-7 text-center">
            <div class="alert alert-success py-5" role="alert">
                File anda berhasil di download
            </div>
        </div>
    </div>
    <div class="d-none">
        <table id="data">
            <tr>
                <th class="text-uppercase">No.</th>
                <th class="text-uppercase">Nama Akun</th>
                <th class="text-uppercase">Nama Lengkap</th>
                <th class="text-uppercase">Jenis Kelamin</th>
                <th class="text-uppercase">Agama</th>
                <th class="text-uppercase">Nomor Induk Kependudukan (NIK)</th>
                <th class="text-uppercase">NPWP Pribadi</th>
                <th class="text-uppercase">Tempat Lahir</th>
                <th class="text-uppercase">Tanggal Lahir</th>
                <th class="text-uppercase">Pendidikan Terakhir</th>
                <th class="text-uppercase">No. Telp/HP</th>
                <th class="text-uppercase">Email</th>
                <th class="text-uppercase">Alamat Rumah</th>
                <th class="text-uppercase">Provinsi</th>
                <th class="text-uppercase">Kab/Kota</th>

                <th class="text-uppercase">Nama Usaha</th>
                <th class="text-uppercase">Alamat Usaha</th>
                <th class="text-uppercase">Sektor Usaha</th>
                <th class="text-uppercase">Bidang Usaha</th>
                <th class="text-uppercase">Tanggal Pendirian Usaha</th>
                <th class="text-uppercase">Nomor IUMK atau NIB (Nomor Induk Berusaha)</th>
                <th class="text-uppercase">NPWP Usaha</th>
                <th class="text-uppercase">Kekayaan Usaha (Asset) per Tahun</th>
                <th class="text-uppercase">Volume Usaha (Omset) per Tahun</th>
                <th class="text-uppercase">Jumlah Karyawan</th>
                <th class="text-uppercase">Kapasitas Produksi per Tahun</th>
                <th class="text-uppercase">Anggota Koperasi</th>
            </tr>
            @php $no=1; @endphp
            @foreach ($data_users as $users)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $users->username }}</td>
                    <td>{{ $users->name }}</td>
                    <td>{{ $users->gender }}</td>
                    <td>{{ $users->enum_religi }}</td>
                    <td>{{ $users->no_ktp }}</td>
                    <td>{{ $users->npwp }}</td>
                    <td>{{ $users->tmp_lahir }}</td>
                    <td>{{ $users->tgl_lahir }}</td>
                    <td>{{ $users->enum_edu }}</td>
                    <td>{{ $users->phone_number }}</td>
                    <td>{{ $users->email }}</td>
                    <td>{{ $users->address }}</td>
                    <td>{{ $users->enum_prov }}</td>
                    <td>{{ $users->enum_city }}</td>

                    <td>{{ $users->company }}</td>
                    <td>{{ $users->alamat_usaha }}</td>
                    <td>{{ $users->enum_sektor }}</td>
                    <td>{{ $users->enum_bidang }}</td>
                    <td>{{ $users->tgl_b_us }}</td>
                    <td>{{ $users->iumkm }}</td>
                    <td>{{ $users->npwp_usaha }}</td>
                    <td>Rp{{ number_format($users->kaya_usaha,0,".",".") }}</td>
                    <td>Rp{{ number_format($users->volume_usaha,0,".",".") }}</td>
                    <td>{{ number_format($users->emp_amount,0,".",".") }} Orang</td>
                    <td>{{ $users->capacity }}</td>
                    <td>{{ ($users->koperasi == "0") ? "Tidak" : "Ya" }}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/exportCsv.js') }}"></script>
    <script>
        $(document).ready(function() {
            exportTableToExcel('data', 'Detail Pengguna Lamikro')
            $(".preloader").fadeOut();
            $("#download-success").removeClass('d-none');
        })
    </script>
</body>
</html>