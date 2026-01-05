@extends('layouts.admin.app')
@section('title', 'Tambah Pengaduan Warga')
@section('content')

{{-- HEADER --}}
<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap px-4">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Tambah Pengaduan Warga</h4>
            <h6 class="section-title bg-white text-primary px-3">
                Form tambah pengaduan warga 
            </h6>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('pengaduan.index') }}" class="btn btn-primary">
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
            <i class="fas fa-table me-2"></i> Form Tambah Pengaduan
        </div>

        <div class="card-body">
            <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <tbody>

                            {{-- Nomor Tiket --}}
                            <tr>
                                <th class="bg-light w-25">Nomor Tiket</th>
                                <td>
                                    <input type="text" name="nomor_tiket" class="form-control"
                                           placeholder="Masukkan nomor tiket" required>
                                </td>
                            </tr>

                            {{-- Warga --}}
                            <tr>
                                <th class="bg-light">Warga</th>
                                <td>
                                    <select name="warga_id" class="form-select" required>
                                        <option value="">-- Pilih Warga --</option>
                                        @foreach ($warga as $w)
                                            <option value="{{ $w->warga_id }}">{{ $w->nama }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            {{-- Kategori --}}
                            <tr>
                                <th class="bg-light">Kategori</th>
                                <td>
                                    <select name="kategori_id" class="form-select" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->kategori_id }}">{{ $k->nama }}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>

                            {{-- Judul --}}
                            <tr>
                                <th class="bg-light">Judul Pengaduan</th>
                                <td>
                                    <input type="text" name="judul" class="form-control"
                                           placeholder="Masukkan judul pengaduan" required>
                                </td>
                            </tr>

                            {{-- Deskripsi --}}
                            <tr>
                                <th class="bg-light">Deskripsi</th>
                                <td>
                                    <textarea name="deskripsi" rows="4" class="form-control"
                                              placeholder="Tuliskan deskripsi pengaduan" required></textarea>
                                </td>
                            </tr>

                            {{-- Status --}}
                            <tr>
                                <th class="bg-light">Status</th>
                                <td>
                                    <select name="status" class="form-select" required>
                                        <option value="">-- Pilih Status --</option>
                                        <option value="baru">Baru</option>
                                        <option value="diproses">Diproses</option>
                                        <option value="selesai">Selesai</option>
                                    </select>
                                </td>
                            </tr>

                            {{-- Lokasi --}}
                            <tr>
                                <th class="bg-light">Lokasi</th>
                                <td>
                                    <input type="text" name="lokasi_text" class="form-control"
                                           placeholder="Masukkan lokasi pengaduan" required>
                                </td>
                            </tr>

                            {{-- RT RW --}}
                            <tr>
                                <th class="bg-light">RT / RW</th>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6 mb-2 mb-md-0">
                                            <input type="text" name="rt" class="form-control"
                                                   placeholder="RT" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="rw" class="form-control"
                                                   placeholder="RW" required>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            {{-- Lampiran --}}
                            <tr>
                                <th class="bg-light">Lampiran Bukti</th>
                                <td>
                                    <input type="file" name="media[]" class="form-control" multiple>
                                    <small class="text-muted">
                                        Dapat mengunggah lebih dari satu file
                                    </small>
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
                    <a href="{{ route('pengaduan.index') }}"
                       class="btn btn-outline-secondary px-4 rounded-pill">
                        <i class="fas fa-times me-1"></i> Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
