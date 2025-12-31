@extends('layouts.admin.app')
@section('title', 'Tambah Tindak Lanjut')
@section('content')

{{-- start content --}}
<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Tambah Tindak Lanjut</h4>
            <h6 class="section-title bg-white text-primary px-3">Form untuk menambah data tindak lanjut</h6>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('tindaklanjut.index') }}" class="btn btn-primary">
                <i class="far fa-question-circle me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success text-center mt-3">
        {!! session('success') !!}
    </div>
@endif

<!-- Card Style Form -->
<div class="container-fluid py-5 px-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
                <div class="course-item bg-light shadow-sm rounded-3 p-4" style="display: block;">
                    <form action="{{ route('tindaklanjut.store') }}" method="POST">
                        @csrf

                        <div class="text-center mb-4">
                            <h5 class="fw-bold text-dark mb-1">Tambah Data Tindak Lanjut Baru</h5>
                            <small class="text-muted">Isi data tindak lanjut sesuai kebutuhan</small>
                        </div>

                        <!-- Pengaduan ID -->
                        <div class="mb-3">
                            <label for="pengaduan_id" class="form-label fw-semibold text-primary">ID Pengaduan</label>
                            <select name="pengaduan_id" id="pengaduan_id" class="form-select shadow-sm" required>
                                <option value="">-- Pilih Pengaduan --</option>
                                @foreach($pengaduan as $p)
                                    <option value="{{ $p->id }}">
                                        {{ $p->nomor_tiket }} - {{ $p->judul }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <!-- Petugas -->
                        <div class="mb-3">
                            <label for="petugas" class="form-label fw-semibold text-primary">Petugas</label>
                            <input type="text" name="petugas" id="petugas" class="form-control shadow-sm"
                                placeholder="Masukkan Nama Petugas" required>
                        </div>

                        <!-- Aksi -->
                        <div class="mb-3">
                            <label for="aksi" class="form-label fw-semibold text-primary">Aksi</label>
                            <input type="text" name="aksi" id="aksi" class="form-control shadow-sm"
                                placeholder="Masukkan Aksi Tindak Lanjut" required>
                        </div>

                        <!-- Catatan -->
                        <div class="mb-3">
                            <label for="catatan" class="form-label fw-semibold text-primary">Catatan</label>
                            <textarea name="catatan" id="catatan" class="form-control shadow-sm" rows="4"
                                placeholder="Masukkan Catatan jika ada"></textarea>
                        </div>

                        <!-- Tombol Simpan & Batal -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success px-4 me-2 rounded-pill">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                            <a href="{{ route('tindaklanjut.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Card Style Form -->

{{-- end content --}}
@endsection
