@extends('layouts.admin.app')
@section('title', 'Edit User')
@section('content')

<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Edit User</h4>
            <h6 class="section-title bg-white text-primary px-3">
                Form edit data user 
            </h6>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('user.index') }}" class="btn btn-primary">
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
            <i class="fas fa-user-edit me-2"></i> Form Edit User
        </div>

        <div class="card-body">
            <form action="{{ route('user.update', $dataUser->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <tbody>

                            {{-- FOTO PROFIL --}}
                            <tr>
                                <th class="bg-light w-25">Foto Profil</th>
                                <td class="text-center">
                                    <img src="{{ $dataUser->profile_picture_url }}"
                                         id="profile-picture-preview"
                                         class="rounded-circle border mb-3"
                                         width="140" height="140"
                                         style="object-fit: cover;">

                                    @if($dataUser->profile_picture)
                                        <div class="form-check d-flex justify-content-center mb-2">
                                            <input class="form-check-input"
                                                   type="checkbox"
                                                   name="remove_profile_picture"
                                                   id="remove_profile_picture"
                                                   value="1">
                                            <label class="form-check-label text-danger ms-2">
                                                Hapus Foto Profil
                                            </label>
                                        </div>
                                    @endif

                                    <input type="file"
                                           name="profile_picture"
                                           id="profile_picture"
                                           class="form-control"
                                           accept="image/*"
                                           onchange="previewImage(this)">
                                    <small class="text-muted">
                                        JPG, PNG, GIF (Max 2MB)
                                    </small>
                                </td>
                            </tr>

                            {{-- NAMA --}}
                            <tr>
                                <th class="bg-light">Nama Lengkap</th>
                                <td>
                                    <input type="text" name="name" class="form-control"
                                           value="{{ $dataUser->name }}" required>
                                </td>
                            </tr>

                            {{-- EMAIL --}}
                            <tr>
                                <th class="bg-light">Email</th>
                                <td>
                                    <input type="email" name="email" class="form-control"
                                           value="{{ $dataUser->email }}" required>
                                </td>
                            </tr>

                            {{-- PASSWORD BARU --}}
                            <tr>
                                <th class="bg-light">Password Baru</th>
                                <td>
                                    <input type="password" name="password"
                                           class="form-control"
                                           placeholder="Kosongkan jika tidak ingin mengubah">
                                </td>
                            </tr>

                            {{-- KONFIRMASI PASSWORD --}}
                            <tr>
                                <th class="bg-light">Konfirmasi Password</th>
                                <td>
                                    <input type="password"
                                           name="password_confirmation"
                                           class="form-control"
                                           placeholder="Ulangi password baru">
                                </td>
                            </tr>

                            {{-- ROLE --}}
                            <tr>
                                <th class="bg-light">Role</th>
                                <td>
                                    <select name="role" class="form-select" required>
                                        <option value="admin" {{ $dataUser->role == 'admin' ? 'selected' : '' }}>
                                            Admin
                                        </option>
                                        <option value="pelanggan" {{ $dataUser->role == 'pelanggan' ? 'selected' : '' }}>
                                            Pelanggan
                                        </option>
                                        <option value="mitra" {{ $dataUser->role == 'mitra' ? 'selected' : '' }}>
                                            Mitra
                                        </option>
                                    </select>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                {{-- TOMBOL --}}
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-4 me-2 rounded-pill">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                    <a href="{{ route('user.index') }}"
                       class="btn btn-outline-secondary px-4 rounded-pill">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- PREVIEW SCRIPT --}}
<script>
function previewImage(input) {
    const preview = document.getElementById('profile-picture-preview');
    const file = input.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = e => {
        preview.src = e.target.result;
        document.getElementById('remove_profile_picture')?.checked = false;
    };
    reader.readAsDataURL(file);
}

document.getElementById('remove_profile_picture')?.addEventListener('change', function () {
    const preview = document.getElementById('profile-picture-preview');
    if (this.checked) {
        preview.src = '{{ asset("default-avatar.png") }}';
        document.getElementById('profile_picture').value = '';
    } else {
        preview.src = '{{ $dataUser->profile_picture_url }}';
    }
});
</script>

@endsection
