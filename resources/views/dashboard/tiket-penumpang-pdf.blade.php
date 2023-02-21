<!DOCTYPE html>
<html>

<head>
    <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }
    </style>
    <center>
        <h5>Tiket Penumpang</h5>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>Nama</th>
                <th>No HP / KTP</th>
                <th>Usia</th>
                <th>Jenis Kelamin</th>
                <th>Golongan</th>
                <th>Harga</th>
                <th>tanggal</th>
                <th>Asal</th>
                <th>Tujuan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $penumpang->nama }}</td>
                <td>{{ $penumpang->noHp }}</td>
                <td>{{ $penumpang->usia }}</td>
                <td>{{ $penumpang->jk }}</td>
                <td>{{ $penumpang->golongan }}</td>
                <td>{{ $penumpang->harga }}</td>
                <td>{{ date('d-m-Y', strtotime($penumpang->tanggal)) }}</td>
                <td>{{ $penumpang->asal }}</td>
                <td>{{ $penumpang->tujuan }}</td>
            </tr>
        </tbody>
    </table>

</body>

</html>
