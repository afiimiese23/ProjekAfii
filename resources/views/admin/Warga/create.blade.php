@extends('layouts.admin.app')
@section('title', 'Tambah Warga Pengaduan')
@section('content')

{{-- start content --}}
<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Tambah Warga Pengaduan</h4>
            <h6 class="section-title bg-white text-primary px-3">Form untuk menambah Data Warga</h6>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('warga.index') }}" class="btn btn-primary">
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
                    <form action="{{ route('warga.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="text-center mb-4">
                            <h5 class="fw-bold text-dark mb-1">Tambah Data Warga Baru</h5>
                            <small class="text-muted">Isi data warga sesuai kebutuhan</small>
                        </div>

                        {{-- FOTO PROFILE --}}
                        <div class="mb-3"> 
                            <label for="profile_picture" class="form-label">Foto Profil</label> 
                            <input type="file" id="profile_picture" name="profile_picture" class="form-control" accept="image/*"> 
                            <div class="form-text">Format: JPG, PNG, GIF. Maksimal: 2MB</div> 
                            @error('profile_picture') 
                                <div class="text-danger small">{{ $message }}</div> 
                            @enderror 
                        </div> 

                        <!-- No KTP -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary">Nomor KTP</label>
                            <input type="text" name="no_ktp" class="form-control shadow-sm"
                                placeholder="Masukkan Nomor KTP" required>
                        </div>

                        <!-- Nama -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary">Nama</label>
                            <input type="text" name="nama" class="form-control shadow-sm"
                                placeholder="Masukkan Nama Warga" required>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select shadow-sm" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="Male">Laki-Laki</option>
                                <option value="Female">Perempuan</option>
                            </select>
                        </div>

                        <!-- Agama -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary">Agama</label>
                            <input type="text" name="agama" class="form-control shadow-sm" required>
                        </div>

                        <!-- Pekerjaan -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary">Pekerjaan</label>
                            <input type="text" name="pekerjaan" class="form-control shadow-sm" required>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-primary">Nomor Telepon</label>
                            <input type="text" name="phone" class="form-control shadow-sm" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-primary">Email</label>
                            <input type="email" name="email" class="form-control shadow-sm" required>
                        </div>

                        <!-- Tombol -->
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-success px-4 me-2 rounded-pill">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                            <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">
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
