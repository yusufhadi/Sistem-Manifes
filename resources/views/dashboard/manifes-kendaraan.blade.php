@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Daftar Manifess Kendaraan</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form action="{{ route('manifes-kendaraan') }}" method="GET">
                <div class="row mt-3">
                    <select name="bulan" class="form-select col-md-1 ml-3">
                        <option value="">Semua</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                    </select>
                    <button type="submit" class="btn btn-primary col-md-1 ml-3">Filter</button>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Plat</th>
                            <th>No Tiket</th>
                            <th>Jenis Barang</th>
                            <th>Jenis Kendaraan</th>
                            <th>Golongan</th>
                            <th>Tanggal Pemberangkatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kendaraan as $k)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $k->nama }}</td>
                                <td>{{ $k->plat }}</td>
                                <td>{{ $k->tiket }}</td>
                                <td>{{ $k->barang }}</td>
                                <td>{{ $k->kendaraan }}</td>
                                <td>{{ $k->golongan }}</td>
                                <td> Jam {{ date('H:i', strtotime($k->tgl_keberangkatan)) }}, Tanggal
                                    {{ date('d-m-y', strtotime($k->tgl_keberangkatan)) }}</td>
                                <td>
                                    <a href="{{ route('download-kendaraan', $k->id) }}" target="_blank"
                                        class="btn btn-success btn-sm mr-1">
                                        <i class="fas fa-print"></i></a>
                                    <a href="" class="btn btn-warning btn-sm mr-1" data-bs-toggle="modal"
                                        data-bs-target="#updateKendaraan-{{ $k->id }}"> <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="{{ route('delete-kendaraan', $k->id) }}" class="btn btn-danger btn-sm mr-1">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak Ada Data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit Tiket Penumpang -->
    @foreach ($kendaraan as $item)
        <div class="modal fade" id="updateKendaraan-{{ $item->id }}" tabindex="-1"
            aria-labelledby="UpdateKendaraanModal" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="UpdateKendaraanModal">Update Tiket Kendaraan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('update-kendaraan', $item->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="mb-3 col-md-3">
                                    <label for="nama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" value="{{ $item->nama }}" name="nama"
                                        required>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="plat" class="form-label">No Plat</label>
                                    <input type="text" class="form-control" value="{{ $item->plat }}" name="plat"
                                        required>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="tiket" class="form-label">No Tiket</label>
                                    <input type="text" class="form-control" value="{{ $item->tiket }}" name="tiket"
                                        required>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="barang" class="form-label">Jenis Barang</label>
                                    <input type="text" class="form-control" value="{{ $item->barang }}" name="barang"
                                        required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-4">
                                    <label for="kendaraan" class="form-label">Jenis Kendaraan</label>
                                    <input type="text" class="form-control" value="{{ $item->kendaraan }}"
                                        name="kendaraan" required>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="golongan" class="form-label">Golongan</label>
                                    <select name="golongan" class="form-select" required>
                                        <option selected>{{ $item->golongan }}</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="tgl_keberangkatan" class="form-label">Tanggal Pemberangkatan</label>
                                    <select name="tgl_keberangkatan" class="form-select" required>
                                        @foreach ($jadwal as $j)
                                            <option value="{{ $j->jadwal }}" selected>Jam
                                                {{ date('H:i', strtotime($j->jadwal)) }}, Tanggal
                                                {{ date('d-m-y', strtotime($j->jadwal)) }}</option>
                                        @endforeach
                                    </select>
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
