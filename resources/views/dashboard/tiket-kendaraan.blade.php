@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tiket Kendaraan</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Masukkan Data Kendaraan</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('tambah-kendaraan') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="plat" class="form-label">No Plat</label>
                        <input type="text" class="form-control" name="plat" required>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="tiket" class="form-label">No Tiket</label>
                        <input type="text" class="form-control" name="tiket" required>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-3">
                        <label for="barang" class="form-label">Jenis Barang</label>
                        <input type="text" class="form-control" name="barang" required>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="kendaraan" class="form-label">Jenis Kendaraan</label>
                        <input type="text" class="form-control" name="kendaraan" required>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="golongan" class="form-label">Golongan</label>
                        <select name="golongan" class="form-select" required>
                            <option selected>Pilih</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="golongan" class="form-label">Tanggal Pemberangkatan</label>
                        <select name="golongan" class="form-select" required>
                            <option selected>Pilih</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
