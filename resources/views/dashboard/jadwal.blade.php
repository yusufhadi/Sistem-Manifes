@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Jadwal Keberangkatan Kapal</h1>
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
                            <th>Nama Kapal</th>
                            <th>Jadwal Keberangkatan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwal as $j)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $j->kapal }}</td>
                                <td>Jam {{ date('H:i', strtotime($j->jadwal)) }}, Tanggal
                                    {{ date('d-m-y', strtotime($j->jadwal)) }}
                                </td>
                                <td>
                                    <a href="" class="btn btn-warning btn-sm mr-1" data-bs-toggle="modal"
                                        data-bs-target="#updateJadwal-{{ $j->id }}"> <i class="fas fa-pen"></i>
                                    </a>
                                    <a href="{{ route('delete-jadwal', $j->id) }}" class="btn btn-danger btn-sm mr-1"> <i
                                            class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Data Kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Jadwal -->
    <div class="modal fade" id="addJadwal" tabindex="-1" aria-labelledby="addJadwalModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addJadwalModal">Tambah Jadwal Keberangkatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('tambah-jadwal') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kapal" class="form-label">Nama Kapal</label>
                            <input type="text" class="form-control" name="kapal" required>
                        </div>
                        <div class="mb-3">
                            <label for="jadwal" class="form-label">Waktu Keberangkatan</label>
                            <input type="datetime-local" id="jadwal" class="form-control" name="jadwal" required>
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


    <!-- Modal Edit Jadwal -->
    @foreach ($jadwal as $item)
        <div class="modal fade" id="updateJadwal-{{ $item->id }}" tabindex="-1" aria-labelledby="UpdateJadwalModal"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="UpdateJadwalModal">Update Jadwal Keberangkatan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('update-jadwal', $item->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="kapal" class="form-label">Nama Kapal</label>
                                <input type="text" class="form-control" value="{{ $item->kapal }}" name="kapal">
                            </div>
                            <div class="mb-3">
                                <label for="jadwal" class="form-label">Waktu Keberangkatan</label>
                                <input type="date" id="waktu" class="form-control" value="{{ $item->jadwal }}"
                                    name="jadwal">
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
