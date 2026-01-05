@extends('layouts.admin.app')
@section('title', 'Edit Tindak Lanjut')
@section('content')

<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Edit Tindak Lanjut</h4>
            <h6 class="section-title bg-white text-primary px-3">
                Form edit tindak lanjut pengaduan 
            </h6>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('tindaklanjut.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success text-center mt-3">
        {!! session('success') !!}
    </div>
@endif

<div class="container-fluid py-4 px-4">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-warning text-dark fw-semibold">
            <i class="fas fa-edit me-2"></i> Edit Data Tindak Lanjut
        </div>

        <div class="card-body">
            <form action="{{ route('tindaklanjut.update', $dataTindakLanjut->tindak_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <tbody>
                            <!-- Pengaduan -->
                            <tr>
                                <th class="bg-light w-25">Pengaduan</th>
                                <td>
                                    <select name="pengaduan_id" class="form-select" required>
                                        @foreach ($pengaduan as $p)
                                            <option value="{{ $p->id }}"
                                                {{ $p->id == $dataTindakLanjut->pengaduan_id ? 'selected' : '' }}>
                                                {{ $p->nomor_tiket }} - {{ $p->judul }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <!-- Petugas -->
                            <tr>
                                <th class="bg-light">Petugas</th>
                                <td>
                                    <input type="text" name="petugas" class="form-control"
                                           value="{{ $dataTindakLanjut->petugas }}" required>
                                </td>
                            </tr>

                            <!-- Aksi -->
                            <tr>
                                <th class="bg-light">Aksi</th>
                                <td>
                                    <input type="text" name="aksi" class="form-control"
                                           value="{{ $dataTindakLanjut->aksi }}" required>
                                </td>
                            </tr>

                            <!-- Catatan -->
                            <tr>
                                <th class="bg-light">Catatan</th>
                                <td>
                                    <textarea name="catatan" rows="3" class="form-control">{{ $dataTindakLanjut->catatan }}</textarea>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Tombol -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-4 me-2 rounded-pill">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                    <a href="{{ route('tindaklanjut.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
