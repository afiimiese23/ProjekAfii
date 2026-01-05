@extends('layouts.admin.app')
@section('title', 'Detail Tindak Lanjut')
@section('content')

<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Detail Tindak Lanjut</h4>
            <h6 class="section-title bg-white text-primary px-3">
                Informasi lengkap tindak lanjut 
            </h6>
        </div>
        <div class="text-center mt-3">
            <a href="{{ route('tindaklanjut.index') }}" class="btn btn-primary">
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
@if (session('error'))
    <div class="alert alert-danger text-center mt-3">
        {!! session('error') !!}
    </div>
@endif

<div class="container-fluid py-4 px-4">

    {{-- ================= INFORMASI TINDAK LANJUT ================= --}}
    <div class="card shadow-sm border-0 rounded-3 mb-4">
        <div class="card-header bg-primary text-white fw-semibold">
            <i class="fas fa-info-circle me-2"></i> Informasi Tindak Lanjut
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <tbody>
                        <tr>
                            <th class="bg-light w-25">Tindak ID</th>
                            <td>{{ $dataTindakLanjut->tindak_id }}</td>
                        </tr>

                        <tr>
                            <th class="bg-light">Pengaduan</th>
                            <td>
                                {{ $dataTindakLanjut->pengaduan->nomor_tiket ?? '-' }}
                                -
                                {{ $dataTindakLanjut->pengaduan->judul ?? '-' }}
                            </td>
                        </tr>

                        <tr>
                            <th class="bg-light">Petugas</th>
                            <td>{{ $dataTindakLanjut->petugas }}</td>
                        </tr>

                        <tr>
                            <th class="bg-light">Aksi</th>
                            <td>{{ $dataTindakLanjut->aksi }}</td>
                        </tr>

                        <tr>
                            <th class="bg-light">Catatan</th>
                            <td>{{ $dataTindakLanjut->catatan ?? '-' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('tindaklanjut.edit', $dataTindakLanjut->tindak_id) }}"
                   class="btn btn-warning px-4 rounded-pill">
                    <i class="fas fa-edit me-1"></i> Edit Data
                </a>
            </div>
        </div>
    </div>

    {{-- ================= UPLOAD FILE ================= --}}
    <div class="card shadow-sm border-0 rounded-3 mb-4">
        <div class="card-header bg-success text-white fw-semibold">
            <i class="fas fa-upload me-2"></i> Upload File Pendukung
        </div>

        <div class="card-body">
            <form action="{{ route('tindaklanjut.upload-files', $dataTindakLanjut->tindak_id) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Pilih File</label>
                    <input type="file" name="files[]" class="form-control" multiple required
                           accept=".doc,.docx,.pdf,.jpg,.jpeg,.png,.gif,.txt">
                    <small class="text-muted">
                        DOC, DOCX, PDF, JPG, PNG, GIF, TXT (Max 2MB)
                    </small>
                </div>

                <button type="submit" class="btn btn-success px-4 rounded-pill">
                    <i class="fas fa-upload me-1"></i> Upload
                </button>
            </form>
        </div>
    </div>

    {{-- ================= DAFTAR FILE ================= --}}
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-secondary text-white fw-semibold">
            <i class="fas fa-folder-open me-2"></i> File Pendukung
        </div>

        <div class="card-body">

            @if($dataTindakLanjut->files->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nama File</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataTindakLanjut->files as $file)
                                <tr>
                                    <td>{{ basename($file->filename) }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ $file->file_url }}" target="_blank"
                                               class="btn btn-sm btn-info text-white rounded-pill">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <a href="{{ $file->file_url }}" download
                                               class="btn btn-sm btn-success rounded-pill">
                                                <i class="fas fa-download"></i>
                                            </a>

                                            <form action="{{ route('tindaklanjut.delete-file', [$dataTindakLanjut->tindak_id, $file->id]) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Hapus file ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger rounded-pill">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-4 text-muted">
                    <i class="fas fa-folder-open fa-3x mb-2"></i>
                    <p>Belum ada file pendukung</p>
                </div>
            @endif

        </div>
    </div>

</div>

@endsection
