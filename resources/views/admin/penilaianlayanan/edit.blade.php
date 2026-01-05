@extends('layouts.admin.app')
@section('title', 'Edit Penilaian Layanan')
@section('content')

<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Edit Penilaian Layanan</h4>
            <h6 class="section-title bg-white text-primary px-3">
                Form edit penilaian layanan 
            </h6>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('penilaianlayanan.index') }}" class="btn btn-primary">
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
            <i class="fas fa-edit me-2"></i> Edit Data Penilaian Layanan
        </div>

        <div class="card-body">
            <form action="{{ route('penilaianlayanan.update', $dataPenilaianLayanan->penilaian_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <tbody>
                            <!-- Pengaduan -->
                            <tr>
                                <th class="bg-light w-25">Pengaduan</th>
                                <td>
                                    <select name="pengaduan_id" class="form-select" required>
                                        @foreach ($dataPengaduan as $p)
                                            <option value="{{ $p->id }}"
                                                {{ old('pengaduan_id', $dataPenilaianLayanan->pengaduan_id) == $p->id ? 'selected' : '' }}>
                                                {{ $p->nomor_tiket }} - {{ $p->judul }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('pengaduan_id')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>

                            <!-- Rating -->
                            <tr>
                                <th class="bg-light">Rating</th>
                                <td>
                                    <select name="rating" class="form-select" required>
                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}"
                                                {{ $dataPenilaianLayanan->rating == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('rating')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>

                            <!-- Komentar -->
                            <tr>
                                <th class="bg-light">Komentar</th>
                                <td>
                                    <textarea name="komentar" rows="3" class="form-control">{{ $dataPenilaianLayanan->komentar }}</textarea>
                                    @error('komentar')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Tombol -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-4 me-2 rounded-pill">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                    <a href="{{ route('penilaianlayanan.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
