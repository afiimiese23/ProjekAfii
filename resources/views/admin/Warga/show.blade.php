@extends('layouts.admin.app')
@section('title', 'Detail Warga')
@section('content')

<div class="py-4 px-4">

    <div class="d-flex justify-content-between w-100 flex-wrap mb-4">
        <div>
            <h4 class="display-3 text-black text-center">Detail Warga</h4>
            <h6 class="section-title bg-white text-primary px-3 text-center">
                Informasi lengkap warga dan file pendukung
            </h6>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('warga.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    {{-- Alert --}}
    @if (session('success'))
        <div class="alert alert-success">{!! session('success') !!}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{!! session('error') !!}</div>
    @endif


    <div class="container px-4">

        {{-- CARD INFORMASI WARGA --}}
        <div class="course-item bg-light shadow-sm rounded-3 p-4 mb-4">

            <h5 class="fw-bold mb-3 text-dark">Informasi Warga</h5>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <strong>Nama Lengkap</strong><br>
                    <span>{{ $dataWarga->nama }}</span>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>No KTP</strong><br>
                    <span>{{ $dataWarga->no_ktp }}</span>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Jenis Kelamin</strong><br>
                    <span>{{ $dataWarga->jenis_kelamin }}</span>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Agama</strong><br>
                    <span>{{ $dataWarga->agama }}</span>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Pekerjaan</strong><br>
                    <span>{{ $dataWarga->pekerjaan }}</span>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Phone</strong><br>
                    <span>{{ $dataWarga->phone ?? '-' }}</span>
                </div>

                <div class="col-md-6 mb-3">
                    <strong>Email</strong><br>
                    <span>{{ $dataWarga->email }}</span>
                </div>
            </div>

            <div class="mt-3 text-center">
                <a href="{{ route('warga.edit', $dataWarga->warga_id) }}"
                   class="btn btn-info text-white rounded-pill px-4">
                    <i class="fas fa-edit me-1"></i> Edit Data
                </a>
            </div>
        </div>




        {{-- CARD UPLOAD FILE --}}
        <div class="course-item bg-light shadow-sm rounded-3 p-4 mb-4">

            <h5 class="fw-bold mb-3 text-dark">Upload File Pendukung</h5>

            <form action="{{ route('warga.upload-files', $dataWarga->warga_id) }}"
                  method="POST" enctype="multipart/form-data">

                @csrf
                <input type="hidden" name="ref_table" value="warga">
                <input type="hidden" name="ref_id" value="{{ $dataWarga->warga_id }}">

                <div class="mb-3">
                    <label class="form-label fw-semibold">Pilih File</label>
                    <input type="file" name="files[]" class="form-control" multiple
                           accept=".doc,.docx,.pdf,.jpg,.jpeg,.png,.gif,.txt" required>
                    <small class="text-muted">
                        Format: DOC, DOCX, PDF, JPG, PNG, GIF, TXT — Maks 2MB.
                    </small>
                </div>

                <button type="submit" class="btn btn-success rounded-pill px-4">
                    <i class="fas fa-upload me-1"></i> Upload
                </button>
            </form>

        </div>




        {{-- CARD DAFTAR FILE --}}
        <div class="course-item bg-light shadow-sm rounded-3 p-4 mb-4">

            <h5 class="fw-bold mb-4 text-dark">File Pendukung</h5>

            @if($dataWarga->files->count() > 0)

                <div class="row g-3">

                    @foreach($dataWarga->files as $file)
                        @php
                            $ext = pathinfo($file->filename, PATHINFO_EXTENSION);
                        @endphp

                        <div class="col-md-4">
                            <div class="bg-white p-3 shadow-sm rounded-3 h-100">

                                {{-- Icon/File Preview --}}
                                <div class="mb-2 text-center">

                                    @if(in_array($ext, ['jpg','jpeg','png','gif']))
                                        <img src="{{ $file->file_url }}" class="img-fluid rounded mb-2"
                                             style="max-height: 150px; object-fit: cover;">
                                    @else
                                        <i class="fas fa-file fa-3x text-primary mb-2"></i>
                                    @endif

                                </div>

                                <p class="text-center fw-semibold mb-2">
                                    {{ basename($file->filename) }}
                                </p>

                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ $file->file_url }}" target="_blank"
                                       class="btn btn-sm btn-info text-white rounded-pill">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ $file->file_url }}" download
                                       class="btn btn-sm btn-success rounded-pill">
                                        <i class="fas fa-download"></i>
                                    </a>

                                    <form action="{{ route('warga.delete-file', [$dataWarga->warga_id, $file->id]) }}"
                                          method="POST" onsubmit="return confirm('Hapus file ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger rounded-pill">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </div>

                            </div>
                        </div>

                    @endforeach

                </div>

            @else
                <div class="text-center py-4">
                    <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada file pendukung.</p>
                </div>
            @endif

        </div>

    </div>

</div>

@endsection
