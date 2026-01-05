@extends('layouts.admin.app')
@section('title', 'Edit Pengaduan Warga')
@section('content')

<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Edit Pengaduan Warga</h4>
            <h6 class="section-title bg-white text-primary px-3">
                Form edit pengaduan warga 
            </h6>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('pengaduan.index') }}" class="btn btn-primary">
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
            <i class="fas fa-edit me-2"></i> Edit Data Pengaduan
        </div>

        <div class="card-body">
            <form action="{{ route('pengaduan.update', $dataPengaduan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <tbody>
                            <tr>
                                <th class="bg-light w-25">Nomor Tiket</th>
                                <td>
                                    <input type="text" name="nomor_tiket" class="form-control"
                                           value="{{ $dataPengaduan->nomor_tiket }}" required>
                                </td>
                            </tr>

                            <tr>
                                <th class="bg-light">Warga</th>
                                <td>
                                    <select name="warga_id" class="form-select" required>
                                        <option value="">-- Pilih Warga --</option>
                                        @foreach ($warga as $w)
                                            <option value="{{ $w->warga_id }}"
                                                {{ $dataPengaduan->warga_id == $w->warga_id ? 'selected' : '' }}>
                                                {{ $w->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th class="bg-light">Kategori</th>
                                <td>
                                    <select name="kategori_id" class="form-select" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->kategori_id }}"
                                                {{ $dataPengaduan->kategori_id == $k->kategori_id ? 'selected' : '' }}>
                                                {{ $k->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th class="bg-light">Judul Pengaduan</th>
                                <td>
                                    <input type="text" name="judul" class="form-control"
                                           value="{{ $dataPengaduan->judul }}" required>
                                </td>
                            </tr>

                            <tr>
                                <th class="bg-light">Deskripsi</th>
                                <td>
                                    <textarea name="deskripsi" rows="4" class="form-control" required>{{ $dataPengaduan->deskripsi }}</textarea>
                                </td>
                            </tr>

                            <tr>
                                <th class="bg-light">Status</th>
                                <td>
                                    <select name="status" class="form-select" required>
                                        <option value="baru" {{ $dataPengaduan->status == 'baru' ? 'selected' : '' }}>Baru</option>
                                        <option value="diproses" {{ $dataPengaduan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="selesai" {{ $dataPengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>
                                <th class="bg-light">Lokasi</th>
                                <td>
                                    <input type="text" name="lokasi_text" class="form-control"
                                           value="{{ $dataPengaduan->lokasi_text }}" required>
                                </td>
                            </tr>

                            <tr>
                                <th class="bg-light">RT</th>
                                <td>
                                    <input type="text" name="rt" class="form-control"
                                           value="{{ $dataPengaduan->rt }}" required>
                                </td>
                            </tr>

                            <tr>
                                <th class="bg-light">RW</th>
                                <td>
                                    <input type="text" name="rw" class="form-control"
                                           value="{{ $dataPengaduan->rw }}" required>
                                </td>
                            </tr>

                            <tr>
                                <th class="bg-light">Lampiran Bukti</th>
                                <td>
                                    <input type="file" name="media[]" class="form-control" multiple>
                                    <small class="text-muted">
                                        Bisa upload lebih dari 1 file. File lama tetap tersimpan.
                                    </small>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success px-4 me-2 rounded-pill">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
