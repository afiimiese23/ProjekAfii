@extends('layouts.admin.app')
@section('title', 'Edit Pengaduan Warga')
@section('content')
{{-- start content --}}
<div class="py-4">
    <div class="d-flex justify-content-between align-items-center w-100 flex-wrap text-center text-md-start">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Edit Pengaduan Warga</h4>
            <h6 class="section-title bg-white text-primary px-3">Form untuk mengedit data pengaduan</h6>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('pengaduan.index') }}" class="btn btn-primary">
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
                <div class="course-item bg-light shadow-sm rounded-3 p-4">
                    <form action="{{ route('pengaduan.update', $dataPengaduan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="text-center mb-4">
                            <h5 class="fw-bold text-dark mb-1">Edit Detail Pengaduan</h5>
                            <small class="text-muted">Ubah data pengaduan sesuai kebutuhan</small>
                        </div>

                        <!-- Nomor Tiket -->
                        <div class="mb-3">
                            <label for="nomor_tiket" class="form-label fw-semibold text-primary">Nomor Tiket</label>
                            <input type="text" name="nomor_tiket" id="nomor_tiket" class="form-control shadow-sm"
                                value="{{ $dataPengaduan->nomor_tiket }}" required>
                        </div>

                        <!-- Warga -->
                        <div class="mb-3">
                            <label for="warga_id" class="form-label fw-semibold text-primary">Warga</label>
                            <select name="warga_id" id="warga_id" class="form-select shadow-sm" required>
                                <option value="">-- Pilih Warga --</option>
                                @foreach($warga as $w)
                                    <option value="{{ $w->warga_id }}" {{ $dataPengaduan->warga_id == $w->warga_id ? 'selected' : '' }}>
                                        {{ $w->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Kategori -->
                        <div class="mb-3">
                            <label for="kategori_id" class="form-label fw-semibold text-primary">Kategori</label>
                            <select name="kategori_id" id="kategori_id" class="form-select shadow-sm" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->kategori_id }}" {{ $dataPengaduan->kategori_id == $k->kategori_id ? 'selected' : '' }}>
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Judul -->
                        <div class="mb-3">
                            <label for="judul" class="form-label fw-semibold text-primary">Judul Pengaduan</label>
                            <input type="text" name="judul" id="judul" class="form-control shadow-sm"
                                value="{{ $dataPengaduan->judul }}" required>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-semibold text-primary">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control shadow-sm" rows="4" required>{{ $dataPengaduan->deskripsi }}</textarea>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold text-primary">Status</label>
                            <select name="status" id="status" class="form-select shadow-sm" required>
                                <option value="baru" {{ $dataPengaduan->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                <option value="diproses" {{ $dataPengaduan->status == 'diproses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ $dataPengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>

                        <!-- Lokasi -->
                        <div class="mb-3">
                            <label for="lokasi_text" class="form-label fw-semibold text-primary">Lokasi</label>
                            <input type="text" name="lokasi_text" id="lokasi_text" class="form-control shadow-sm"
                                value="{{ $dataPengaduan->lokasi_text }}" required>
                        </div>

                        <!-- RT & RW -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="rt" class="form-label fw-semibold text-primary">RT</label>
                                <input type="text" name="rt" id="rt" class="form-control shadow-sm"
                                    value="{{ $dataPengaduan->rt }}" required>
                            </div>
                            <div class="col-md-6">
                                <label for="rw" class="form-label fw-semibold text-primary">RW</label>
                                <input type="text" name="rw" id="rw" class="form-control shadow-sm"
                                    value="{{ $dataPengaduan->rw }}" required>
                            </div>
                        </div>

                        <!-- Upload Media -->
                        <div class="mb-4">
                            <label for="media" class="form-label fw-semibold text-primary">Lampiran Bukti (Foto)</label>
                            <input type="file" name="media[]" id="media" class="form-control shadow-sm" multiple>
                            <small class="text-muted">Bisa mengunggah lebih dari 1 file. File lama tetap ada.</small>
                        </div>

                        <!-- Tombol Simpan & Batal -->
                        <div class="d-flex justify-content-center flex-column flex-sm-row">
                            <button type="submit" class="btn btn-success px-4 me-2 rounded-pill">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                            <a href="{{ route('pengaduan.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">
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
@endsection
