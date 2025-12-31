@extends('layouts.admin.app')
@section('title', 'Tambah Penilaian Layanan')
@section('content')

{{-- start content --}}
<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Tambah Penilaian Layanan</h4>
            <h6 class="section-title bg-white text-primary px-3">
                Form untuk menambah Penilaian Layanan
            </h6>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('penilaianlayanan.index') }}" class="btn btn-primary">
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

                    <form action="{{ route('penilaianlayanan.store') }}" method="POST">
                        @csrf

                        <div class="text-center mb-4">
                            <h5 class="fw-bold text-dark mb-1">Tambah Penilaian Layanan</h5>
                            <small class="text-muted">
                                Isi data penilaian layanan sesuai pengaduan
                            </small>
                        </div>

                        <!-- Pengaduan -->
                        <div class="mb-3">
                            <label for="pengaduan_id" class="form-label fw-semibold text-primary">
                                Pengaduan
                            </label>

                            <select name="pengaduan_id" id="pengaduan_id"
                                class="form-select shadow-sm" required>

                                @foreach ($dataPengaduan as $p)
                                    <option value="{{ $p->id }}"
                                        {{ old('pengaduan_id') == $p->id ? 'selected' : '' }}>
                                        {{ $p->nomor_tiket }} - {{ $p->judul }}
                                    </option>
                                @endforeach

                            </select>

                            @error('pengaduan_id')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Rating -->
                        <div class="mb-3">
                            <label for="rating" class="form-label fw-semibold text-primary">
                                Rating
                            </label>
                            <select name="rating" id="rating"
                                class="form-control shadow-sm" required>
                                <option value="">-- Pilih Rating --</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}"
                                        {{ old('rating') == $i ? 'selected' : '' }}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            @error('rating')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Komentar -->
                        <div class="mb-4">
                            <label for="komentar" class="form-label fw-semibold text-primary">
                                Komentar
                            </label>
                            <textarea name="komentar" id="komentar" rows="3"
                                class="form-control shadow-sm"
                                placeholder="Tulis komentar (opsional)">{{ old('komentar') }}</textarea>
                            @error('komentar')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tombol Simpan & Batal -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success px-4 me-2 rounded-pill">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                            <a href="{{ route('penilaianlayanan.index') }}"
                               class="btn btn-outline-secondary px-4 rounded-pill">
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
