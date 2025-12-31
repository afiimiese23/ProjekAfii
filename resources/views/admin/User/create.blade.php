@extends('layouts.admin.app')
@section('title', 'Tambah User')
@section('content')

{{-- start content --}}
<div class="py-4">
    <div class="d-flex justify-content-between align-items-center w-100 flex-wrap text-center text-md-start">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Tambah User</h4>
            <h6 class="section-title bg-white text-primary px-3">Form untuk menambah User</h6>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('user.index') }}" class="btn btn-primary">
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
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf

                        <div class="text-center mb-4">
                            <h5 class="fw-bold text-dark mb-1">Tambah User Baru</h5>
                            <small class="text-muted">Isi data User sesuai kebutuhan</small>
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold text-primary">Nama Lengkap</label>
                            <input name="name" type="text" id="name" class="form-control shadow-sm" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-primary">Email</label>
                            <input type="email" name="email" id="email" class="form-control shadow-sm" required>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-primary">Password</label>
                            <input name="password" type="password" id="password" class="form-control shadow-sm" required>
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

                        <!-- Role (BARU DITAMBAH) -->
                        <div class="mb-3">
                            <label for="role" class="form-label fw-semibold text-primary">Role</label>
                            <select id="role" name="role" class="form-control shadow-sm" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="pelanggan" {{ old('role') == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                                <option value="mitra" {{ old('role') == 'mitra' ? 'selected' : '' }}>Mitra</option>
                            </select>
                            @error('role')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password Confirmation -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold text-primary">Konfirmasi Password</label>
                            <input name="password_confirmation" type="password" id="password_confirmation"
                                class="form-control shadow-sm" required>
                        </div>

                        <!-- Tombol Simpan & Batal -->
                        <div class="d-flex justify-content-center flex-column flex-sm-row">
                            <button type="submit" class="btn btn-success px-4 me-2 rounded-pill">
                                <i class="fas fa-save me-1"></i> Simpan
                            </button>
                            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">
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
