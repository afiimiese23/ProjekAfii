@extends('layouts.admin.app')
@section('title', 'Edit User')
@section('content')

{{-- start content --}}
<div class="py-4">
    <div class="d-flex justify-content-between align-items-center w-100 flex-wrap text-center text-md-start">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Edit User</h4>
            <h6 class="section-title bg-white text-primary px-3">Form untuk mengedit data User</h6>
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
                    <form action="{{ route('user.update', $dataUser->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="text-center mb-4">
                            <h5 class="fw-bold text-dark mb-1">Edit Detail User</h5>
                            <small class="text-muted">Ubah data user sesuai kebutuhan</small>
                        </div>

                        <!-- FOTO PROFIL -->
                        <div class="mb-4 text-center">
                            <label class="form-label d-block fw-semibold text-primary">Foto Profil Saat Ini</label>

                            <img src="{{ $dataUser->profile_picture_url }}"  
                                id="profile-picture-preview" 
                                alt="Profile Picture"  
                                class="rounded-circle border mb-2" 
                                width="150"  
                                height="150" 
                                style="object-fit: cover;">
                            
                            <div class="mt-2">
                                @if($dataUser->profile_picture)
                                    <div class="form-check d-flex justify-content-center">
                                        <input class="form-check-input" type="checkbox"
                                            name="remove_profile_picture" id="remove_profile_picture" value="1">
                                        <label class="form-check-label text-danger ms-2" for="remove_profile_picture">
                                            Hapus Foto Profil
                                        </label>
                                    </div>
                                @else
                                    <span class="text-muted">Belum ada foto profil</span>
                                @endif
                            </div>
                        </div>

                        <!-- Upload Foto Profil -->
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label fw-semibold text-primary">Upload Foto Profil Baru</label>
                            <input type="file" id="profile_picture" name="profile_picture" class="form-control shadow-sm"
                                accept="image/*" onchange="previewImage(this)">
                            <div class="form-text">Format: JPG, PNG, GIF. Maksimal: 2MB</div>
                            @error('profile_picture')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold text-primary">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control shadow-sm"
                                value="{{ $dataUser->name }}" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold text-primary">Email</label>
                            <input type="email" name="email" id="email" class="form-control shadow-sm"
                                value="{{ $dataUser->email }}" required>
                        </div>

                        <!-- Password Baru -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold text-primary">Password Baru</label>
                            <input type="password" id="password" class="form-control shadow-sm" name="password"
                                placeholder="Kosongkan jika tidak ingin mengubah">
                            @error('password')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold text-primary">Konfirmasi Password Baru</label>
                            <input type="password" id="password_confirmation" class="form-control shadow-sm"
                                name="password_confirmation" placeholder="Kosongkan jika tidak ingin mengubah">
                        </div>

                        <!-- Role -->
                        <div class="mb-3">
                            <label for="role" class="form-label fw-semibold text-primary">Role</label>
                            <select name="role" id="role" class="form-control shadow-sm" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="admin" {{ $dataUser->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="pelanggan" {{ $dataUser->role == 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                                <option value="mitra" {{ $dataUser->role == 'mitra' ? 'selected' : '' }}>Mitra</option>
                            </select>
                            @error('role')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
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
                    
                    <!-- SCRIPT PREVIEW -->
                    <script>
                    function previewImage(input) {
                        const preview = document.getElementById('profile-picture-preview');
                        const file = input.files[0];
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            preview.src = e.target.result;
                            document.getElementById('remove_profile_picture')?.checked = false;
                        }

                        if (file) {
                            reader.readAsDataURL(file);
                        }
                    }
                    document.getElementById('remove_profile_picture')?.addEventListener('change', function() {
                        const preview = document.getElementById('profile-picture-preview');
                        if (this.checked) {
                            preview.src = '{{ asset("assets/images/default-avatar.png") }}';
                            document.getElementById('profile_picture').value = '';
                        } else {
                            preview.src = '{{ $dataUser->profile_picture_url }}';
                        }
                    });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Card Style Form -->

{{-- end content --}}
@endsection
