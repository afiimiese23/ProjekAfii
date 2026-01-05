@extends('layouts.admin.app')
@section('title', 'Edit Kategori Pengaduan')
@section('content')

<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Edit Kategori Pengaduan</h4>
            <h6 class="section-title bg-white text-primary px-3">
                Form edit kategori pengaduan 
            </h6>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('kategori.index') }}" class="btn btn-primary">
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
            <i class="fas fa-edit me-2"></i> Edit Data Kategori
        </div>

        <div class="card-body">
            <form action="{{ route('kategori.update', $dataKategori->kategori_id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <tbody>
                            <!-- Nama Kategori -->
                            <tr>
                                <th class="bg-light w-25">Nama Kategori</th>
                                <td>
                                    <input type="text" name="nama" class="form-control"
                                           value="{{ $dataKategori->nama }}" required>
                                </td>
                            </tr>

                            <!-- SLA -->
                            <tr>
                                <th class="bg-light">SLA (Hari)</th>
                                <td>
                                    <input type="number" name="sla_hari" class="form-control"
                                           value="{{ $dataKategori->sla_hari }}" min="1" required>
                                </td>
                            </tr>

                            <!-- Prioritas -->
                            <tr>
                                <th class="bg-light">Prioritas</th>
                                <td>
                                    <select name="prioritas" class="form-select" required>
                                        <option value="Rendah" {{ $dataKategori->prioritas == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                                        <option value="Sedang" {{ $dataKategori->prioritas == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                        <option value="Tinggi" {{ $dataKategori->prioritas == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                                    </select>
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
                    <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
