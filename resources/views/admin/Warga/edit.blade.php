@extends('layouts.admin.app')
@section('title', 'Edit Data Warga')
@section('content')

<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Edit Data Warga</h4>
            <h6 class="section-title bg-white text-primary px-3">
                Form edit data warga
            </h6>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('warga.index') }}" class="btn btn-primary">
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
            <i class="fas fa-user-edit me-2"></i> Edit Data Warga
        </div>

        <div class="card-body">
            <form action="{{ route('warga.update', $dataWarga->warga_id) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <tbody>

                            {{-- FOTO PROFIL --}}
                            <tr>
                                <th class="bg-light w-25">Foto Profil</th>
                                <td class="text-center">
                                    <img src="{{ $dataWarga->profile_picture_url }}"
                                         id="profile-picture-preview"
                                         class="rounded-circle border mb-3"
                                         width="140" height="140"
                                         style="object-fit: cover;">

                                    @if($dataWarga->profile_picture)
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

                            {{-- NO KTP --}}
                            <tr>
                                <th class="bg-light">Nomor KTP</th>
                                <td>
                                    <input type="text" name="no_ktp"
                                           class="form-control"
                                           value="{{ $dataWarga->no_ktp }}" required>
                                </td>
                            </tr>

                            {{-- NAMA --}}
                            <tr>
                                <th class="bg-light">Nama</th>
                                <td>
                                    <input type="text" name="nama"
                                           class="form-control"
                                           value="{{ $dataWarga->nama }}" required>
                                </td>
                            </tr>

                            {{-- JENIS KELAMIN --}}
                            <tr>
                                <th class="bg-light">Jenis Kelamin</th>
                                <td>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="Male" {{ $dataWarga->jenis_kelamin == 'Male' ? 'selected' : '' }}>
                                            Laki-Laki
                                        </option>
                                        <option value="Female" {{ $dataWarga->jenis_kelamin == 'Female' ? 'selected' : '' }}>
                                            Perempuan
                                        </option>
                                    </select>
                                </td>
                            </tr>

                            {{-- AGAMA --}}
                            <tr>
                                <th class="bg-light">Agama</th>
                                <td>
                                    <input type="text" name="agama"
                                           class="form-control"
                                           value="{{ $dataWarga->agama }}" required>
                                </td>
                            </tr>

                            {{-- PEKERJAAN --}}
                            <tr>
                                <th class="bg-light">Pekerjaan</th>
                                <td>
                                    <input type="text" name="pekerjaan"
                                           class="form-control"
                                           value="{{ $dataWarga->pekerjaan }}" required>
                                </td>
                            </tr>

                            {{-- TELEPON --}}
                            <tr>
                                <th class="bg-light">Nomor Telepon</th>
                                <td>
                                    <input type="text" name="phone"
                                           class="form-control"
                                           value="{{ $dataWarga->phone }}" required>
                                </td>
                            </tr>

                            {{-- EMAIL --}}
                            <tr>
                                <th class="bg-light">Email</th>
                                <td>
                                    <input type="email" name="email"
                                           class="form-control"
                                           value="{{ $dataWarga->email }}" required>
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
                    <a href="{{ route('warga.index') }}"
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
        preview.src = '{{ asset("assets/images/default-avatar.png") }}';
        document.getElementById('profile_picture').value = '';
    } else {
        preview.src = '{{ $dataWarga->profile_picture_url }}';
    }
});
</script>

@endsection
