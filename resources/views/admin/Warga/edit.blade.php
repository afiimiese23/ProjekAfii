@extends('layouts.admin.app')
@section('title', 'Edit Data Warga')
@section('content')
    {{-- start content --}}
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h4 class="display-3 text-black">Edit Data Warga</h4>
                <h6 class="section-title bg-white text-primary px-3">Form untuk Mengedit Data Warga</h6>
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
                    <div class="course-item bg-light shadow-sm rounded-3 p-4">
                        <form action="{{ route('warga.update', $dataWarga->warga_id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="text-center mb-4">
                                <h5 class="fw-bold text-dark mb-1">Edit Data Warga</h5>
                                <small class="text-muted">Ubah data Warga sesuai kebutuhan</small>
                            </div>

                            <!-- No KTP -->
                            <div class="mb-3">
                                <label for="no_ktp" class="form-label fw-semibold text-primary">Nomor KTP</label>
                                <input type="text" name="no_ktp" id="no_ktp" class="form-control shadow-sm"
                                    value="{{ $dataWarga->no_ktp }}" required>
                            </div>

                            <!-- Nama -->
                            <div class="mb-3">
                                <label for="nama" class="form-label fw-semibold text-primary">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control shadow-sm"
                                    value="{{ $dataWarga->nama }}" required>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div class="mb-4">
                                <label for="jenis_kelamin" class="form-label fw-semibold text-primary">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select shadow-sm" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="male" {{ $dataWarga->jenis_kelamin == 'male' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="female" {{ $dataWarga->jenis_kelamin == 'female' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <!-- Agama -->
                            <div class="mb-3">
                                <label for="agama" class="form-label fw-semibold text-primary">Agama</label>
                                <input type="text" name="agama" id="agama" class="form-control shadow-sm"
                                    value="{{ $dataWarga->agama }}" required>
                            </div>
                            
                            <!-- Pekerjaan -->
                            <div class="mb-3">
                                <label for="pekerjaan" class="form-label fw-semibold text-primary">Pekerjaan</label>
                                <input type="text" name="pekerjaan" id="pekerjaan" class="form-control shadow-sm"
                                    value="{{ $dataWarga->pekerjaan }}" required>
                            </div>

                            <!-- Telephone -->
                            <div class="mb-3">
                                <label for="phone" class="form-label fw-semibold text-primary">Nomor Telephone</label>
                                <input type="text" name="phone" id="phone" class="form-control shadow-sm"
                                    value="{{ $dataWarga->phone }}" required>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold text-primary">Email</label>
                                <input type="text" name="email" id="email" class="form-control shadow-sm"
                                    value="{{ $dataWarga->email }}" required>
                            </div>

                            <!-- Tombol Simpan & Batal -->
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
