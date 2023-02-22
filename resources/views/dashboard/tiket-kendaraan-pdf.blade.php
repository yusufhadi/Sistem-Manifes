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
        <h5>Tiket Kendaraan</h5>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>Nama</th>
                <th>No Plat</th>
                <th>No Tiket</th>
                <th>Jenis Barang</th>
                <th>Jenis Kendaraan</th>
                <th>Golongan</th>
                <th>Tanggal Pemberangkatan</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $kendaraan->nama }}</td>
                <td>{{ $kendaraan->plat }}</td>
                <td>{{ $kendaraan->tiket }}</td>
                <td>{{ $kendaraan->barang }}</td>
                <td>{{ $kendaraan->kendaraan }}</td>
                <td>{{ $kendaraan->golongan }}</td>
                <td>Jam {{ date('H:i', strtotime($kendaraan->tgl_keberangkatan)) }}, Tanggal
                    {{ date('d-m-y', strtotime($kendaraan->tgl_keberangkatan)) }}</td>
            </tr>
        </tbody>
    </table>

</body>

</html>
