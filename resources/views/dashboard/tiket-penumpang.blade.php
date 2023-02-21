@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tiket Penumpang</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Masukkan Data Penumpang</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('tambah-tiket-penumpang') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="noHp" class="form-label">No HP / KTP</label>
                        <input type="text" class="form-control" name="noHp" required>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="usia" class="form-label">Usia</label>
                        <input type="number" class="form-control" name="usia" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select name="jk" class="form-select" required>
                            <option selected>Pilih</option>
                            <option value="Perempuan">Perempuan</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="golongan" class="form-label">Golongan</label>
                        <select name="golongan" class="form-select" required>
                            <option selected>Pilih</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control" name="harga" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label for="tanggal" class="form-label">Tanggal Pemberangkatan</label>
                        <input type="date" class="form-control" name="tanggal" required>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="asal" class="form-label">Asal</label>
                        <input type="text" class="form-control" name="asal" required>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="tujuan" class="form-label">Tujuan</label>
                        <input type="text" class="form-control" name="tujuan" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
