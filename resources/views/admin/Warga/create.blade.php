@extends('layouts.admin.app')
@section('title', 'Tambah Warga Pengaduan')
@section('content')

{{-- HEADER --}}
<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap px-4">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Tambah Warga Pengaduan</h4>
            <h6 class="section-title bg-white text-primary px-3">
                Form tambah data warga
            </h6>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('warga.index') }}" class="btn btn-primary">
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
            <i class="fas fa-users me-2"></i> Form Tambah Warga
        </div>

        <div class="card-body">
            <form action="{{ route('warga.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <tbody>

                            {{-- FOTO --}}
                            <tr>
                                <th class="bg-light w-25">Foto Profil</th>
                                <td>
                                    <input type="file"
                                           name="profile_picture"
                                           class="form-control"
                                           accept="image/*">
                                    <small class="text-muted">
                                        JPG, PNG, GIF (Max 2MB)
                                    </small>
                                    @error('profile_picture')
                                        <div class="text-danger small">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>

                            {{-- KTP --}}
                            <tr>
                                <th class="bg-light">Nomor KTP</th>
                                <td>
                                    <input type="text"
                                           name="no_ktp"
                                           class="form-control"
                                           value="{{ old('no_ktp') }}"
                                           required>
                                </td>
                            </tr>

                            {{-- NAMA --}}
                            <tr>
                                <th class="bg-light">Nama</th>
                                <td>
                                    <input type="text"
                                           name="nama"
                                           class="form-control"
                                           value="{{ old('nama') }}"
                                           required>
                                </td>
                            </tr>

                            {{-- JK --}}
                            <tr>
                                <th class="bg-light">Jenis Kelamin</th>
                                <td>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="">-- Pilih --</option>
                                        <option value="Male" {{ old('jenis_kelamin')=='Male'?'selected':'' }}>
                                            Laki-laki
                                        </option>
                                        <option value="Female" {{ old('jenis_kelamin')=='Female'?'selected':'' }}>
                                            Perempuan
                                        </option>
                                    </select>
                                </td>
                            </tr>

                            {{-- AGAMA --}}
                            <tr>
                                <th class="bg-light">Agama</th>
                                <td>
                                    <input type="text"
                                           name="agama"
                                           class="form-control"
                                           value="{{ old('agama') }}"
                                           required>
                                </td>
                            </tr>

                            {{-- PEKERJAAN --}}
                            <tr>
                                <th class="bg-light">Pekerjaan</th>
                                <td>
                                    <input type="text"
                                           name="pekerjaan"
                                           class="form-control"
                                           value="{{ old('pekerjaan') }}"
                                           required>
                                </td>
                            </tr>

                            {{-- PHONE --}}
                            <tr>
                                <th class="bg-light">Nomor Telepon</th>
                                <td>
                                    <input type="text"
                                           name="phone"
                                           class="form-control"
                                           value="{{ old('phone') }}"
                                           required>
                                </td>
                            </tr>

                            {{-- EMAIL --}}
                            <tr>
                                <th class="bg-light">Email</th>
                                <td>
                                    <input type="email"
                                           name="email"
                                           class="form-control"
                                           value="{{ old('email') }}"
                                           required>
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
                    <a href="{{ route('warga.index') }}"
                       class="btn btn-outline-secondary px-4 rounded-pill">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
