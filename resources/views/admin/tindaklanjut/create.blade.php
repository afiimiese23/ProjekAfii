@extends('layouts.admin.app')
@section('title', 'Tambah Tindak Lanjut')
@section('content')

{{-- HEADER --}}
<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap px-4">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Tambah Tindak Lanjut</h4>
            <h6 class="section-title bg-white text-primary px-3">
                Form tambah tindak lanjut 
            </h6>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('tindaklanjut.index') }}" class="btn btn-primary">
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

{{-- FORM TABLE --}}
<div class="container-fluid py-4 px-4">
    <div class="card shadow-sm border-0 rounded-3">

        <div class="card-header bg-primary text-white fw-semibold">
            <i class="fas fa-table me-2"></i> Form Tambah Tindak Lanjut
        </div>

        <div class="card-body">
            <form action="{{ route('tindaklanjut.store') }}" method="POST">
                @csrf

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <tbody>

                            {{-- Pengaduan --}}
                            <tr>
                                <th class="bg-light w-25">Pengaduan</th>
                                <td>
                                    <select name="pengaduan_id" class="form-select" required>
                                        <option value="">-- Pilih Pengaduan --</option>
                                        @foreach($pengaduan as $p)
                                            <option value="{{ $p->id }}"
                                                {{ old('pengaduan_id') == $p->id ? 'selected' : '' }}>
                                                {{ $p->nomor_tiket }} - {{ $p->judul }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            {{-- Petugas --}}
                            <tr>
                                <th class="bg-light">Petugas</th>
                                <td>
                                    <input type="text"
                                           name="petugas"
                                           class="form-control"
                                           placeholder="Masukkan nama petugas"
                                           value="{{ old('petugas') }}"
                                           required>
                                </td>
                            </tr>

                            {{-- Aksi --}}
                            <tr>
                                <th class="bg-light">Aksi</th>
                                <td>
                                    <input type="text"
                                           name="aksi"
                                           class="form-control"
                                           placeholder="Masukkan aksi tindak lanjut"
                                           value="{{ old('aksi') }}"
                                           required>
                                </td>
                            </tr>

                            {{-- Catatan --}}
                            <tr>
                                <th class="bg-light">Catatan</th>
                                <td>
                                    <textarea name="catatan"
                                              rows="4"
                                              class="form-control"
                                              placeholder="Masukkan catatan (opsional)">{{ old('catatan') }}</textarea>
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
                    <a href="{{ route('tindaklanjut.index') }}"
                       class="btn btn-outline-secondary px-4 rounded-pill">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
