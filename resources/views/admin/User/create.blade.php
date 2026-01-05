@extends('layouts.admin.app')
@section('title', 'Tambah User')
@section('content')

{{-- HEADER --}}
<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap px-4">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Tambah User</h4>
            <h6 class="section-title bg-white text-primary px-3">
                Form tambah user 
            </h6>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('user.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>
</div>

{{-- SUCCESS --}}
@if (session('success'))
    <div class="alert alert-success text-center mt-3">
        {!! session('success') !!}
    </div>
@endif

{{-- FORM --}}
<div class="container-fluid py-4 px-4">
    <div class="card shadow-sm border-0 rounded-3">

        <div class="card-header bg-primary text-white fw-semibold">
            <i class="fas fa-user-plus me-2"></i> Form Tambah User
        </div>

        <div class="card-body">
            <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <tbody>

                            <tr>
                                <th class="bg-light w-25">Nama Lengkap</th>
                                <td>
                                    <input type="text" name="name" class="form-control"
                                           value="{{ old('name') }}" required>
                                </td>
                            </tr>

                            <tr>
                                <th class="bg-light">Email</th>
                                <td>
                                    <input type="email" name="email" class="form-control"
                                           value="{{ old('email') }}" required>
                                </td>
                            </tr>

                            <tr>
                                <th class="bg-light">Password</th>
                                <td>
                                    <input type="password" name="password" class="form-control" required>
                                </td>
                            </tr>

                            <tr>
                                <th class="bg-light">Konfirmasi Password</th>
                                <td>
                                    <input type="password" name="password_confirmation"
                                           class="form-control" required>
                                </td>
                            </tr>

                            <tr>
                                <th class="bg-light">Role</th>
                                <td>
                                    <select name="role" class="form-select" required>
                                        <option value="">-- Pilih Role --</option>
                                        <option value="admin" {{ old('role')=='admin'?'selected':'' }}>Admin</option>
                                        <option value="pelanggan" {{ old('role')=='pelanggan'?'selected':'' }}>Pelanggan</option>
                                        <option value="mitra" {{ old('role')=='mitra'?'selected':'' }}>Mitra</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th class="bg-light">Foto Profil</th>
                                <td>
                                    <input type="file" name="profile_picture" class="form-control">
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                {{-- ACTION --}}
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-4 me-2 rounded-pill">
                        <i class="fas fa-save me-1"></i> Simpan
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

@endsection
