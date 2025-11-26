@extends('layouts.admin.app')
@section('title', 'Tambah Kategori Pengaduan')
@section('content')

{{-- start content --}}
<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Tambah Kategori Pengaduan</h4>
            <h6 class="section-title bg-white text-primary px-3">Form untuk menambah kategori pengaduan</h6>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('kategori.index') }}" class="btn btn-primary">
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
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf

                        <div class="text-center mb-4">
                            <h5 class="fw-bold text-dark mb-1">Tambah Kategori Baru</h5>
                            <small class="text-muted">Isi data kategori sesuai kebutuhan</small>
                        </div>

                        <!-- Nama Kategori -->
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-semibold text-primary">Nama Kategori</label>
                            <input type="text" name="nama" id="nama" class="form-control shadow-sm"
                                placeholder="Masukkan nama kategori" required>
                        </div>

                        <!-- SLA (Hari) -->
                        <div class="mb-3">
                            <label for="sla_hari" class="form-label fw-semibold text-primary">SLA (Hari)</label>
                            <input type="number" name="sla_hari" id="sla_hari" class="form-control shadow-sm"
                                placeholder="Masukkan jumlah hari penyelesaian" required min="1">
                        </div>

                        <!-- Prioritas -->
                        <div class="mb-4">
                            <label for="prioritas" class="form-label fw-semibold text-primary">Prioritas</label>
                            <select name="prioritas" id="prioritas" class="form-select shadow-sm" required>
                                <option value="">-- Pilih Prioritas --</option>
                                <option value="Rendah">Rendah</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Tinggi">Tinggi</option>
                            </select>
                        </div>

                        <!-- Tombol Simpan & Batal -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success px-4 me-2 rounded-pill">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                            <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">
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
