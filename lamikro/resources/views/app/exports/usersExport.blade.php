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
                <th>No</th>
                <th>USERNAME</th>
                <th>COMPANY</th>
                <th>NAMA</th>
                <th>EMAIL</th>
                <th>PHONE NUMBER</th>
                <th>ALAMAT</th>
                <th>GROUP</th>
                <th>IUMKM</th>
                <th>NPWP</th>
                <th>NO KTP</th>
                <th>TANGGAL LAHIR</th>
                <th>JENIS KELAMIN</th>
                <th>JENIS USAHA</th>
                <th>LATITUDE</th>
                <th>LONGITUDE</th>
            </tr>
            @php $no=1; @endphp
            @foreach ($data_users as $users)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $users->username }}</td>
                    <td>{{ $users->company }}</td>
                    <td>{{ $users->name }}</td>
                    <td>{{ $users->email }}</td>
                    <td>{{ $users->phone_number }}</td>
                    <td>{{ $users->address }}</td>
                    <td>{{ $users->group }}</td>
                    <td>{{ $users->iumkm }}</td>
                    <td>{{ $users->npwp }}</td>
                    <td>{{ $users->no_ktp }}</td>
                    <td>{{ $users->tgl_lahir }}</td>
                    <td>{{ $users->gender }}</td>
                    <td>{{ $users->jenis_usaha }}</td>
                    <td>{{ $users->latitude }}</td>
                    <td>{{ $users->longitude }}</td>
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