@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Manifess Tiket</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary btn-icon-split btn-sm align-left" data-bs-toggle="modal"
                data-bs-target="#addJadwal">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Jadwal</span>
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No HP / KTP</th>
                            <th>Usia</th>
                            <th>Jenis Kelamin</th>
                            <th>Golongan</th>
                            <th>Harga</th>
                            <th>Tanggal</th>
                            <th>Asal</th>
                            <th>Tujuan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tiket as $t)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $t->nama }}</td>
                                <td>{{ $t->noHp }}</td>
                                <td>{{ $t->usia }}</td>
                                <td>{{ $t->jk }}</td>
                                <td>{{ $t->golongan }}</td>
                                <td>{{ $t->harga }}</td>
                                <td>{{ date('d-m-Y', strtotime($t->tanggal)) }}</td>
                                <td>{{ $t->asal }}</td>
                                <td>{{ $t->tujuan }}</td>
                                <td>
                                    <a href="{{ route('download-penumpang', $t->id) }}" target="_blank"
                                        class="btn btn-success btn-sm mr-1"> <i class="fas fa-print"></i></a>
                                    <a href="" class="btn btn-warning btn-sm mr-1" data-bs-toggle="modal"
                                        data-bs-target="#updateTiket-{{ $t->id }}"> <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="{{ route('delete-tiket-penumpang', $t->id) }}"
                                        class="btn btn-danger btn-sm mr-1"> <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit Tiket Penumpang -->
    @foreach ($tiket as $item)
        <div class="modal fade" id="updateTiket-{{ $item->id }}" tabindex="-1" aria-labelledby="UpdateTiketModal"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="UpdateTiketModal">Update Tiket Penumpang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('update-tiket-penumpang', $item->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" value="{{ $item->nama }}" name="nama"
                                        required>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="noHp" class="form-label">No HP / KTP</label>
                                    <input type="text" class="form-control" value="{{ $item->noHp }}" name="noHp"
                                        required>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="usia" class="form-label">Usia</label>
                                    <input type="number" class="form-control" value="{{ $item->usia }}" name="usia"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="jk" class="form-label">Jenis Kelamin</label>
                                    <select name="jk" class="form-select" required>
                                        <option value="{{ $item->jk }}" selected>Pilih</option>
                                        <option value="Perempuan">Perempuan</option>
                                        <option value="Laki-Laki">Laki-Laki</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="golongan" class="form-label">Golongan</label>
                                    <select name="golongan" class="form-select" required>
                                        <option value="{{ $item->golongan }}" selected>Pilih</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="text" class="form-control" value="{{ $item->harga }}" name="harga"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" value="{{ $item->tanggal }}"
                                        name="tanggal" required>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="asal" class="form-label">Asal</label>
                                    <input type="text" class="form-control" value="{{ $item->asal }}"
                                        name="asal" required>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="tujuan" class="form-label">Tujuan</label>
                                    <input type="text" class="form-control" value="{{ $item->tujuan }}"
                                        name="tujuan" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
