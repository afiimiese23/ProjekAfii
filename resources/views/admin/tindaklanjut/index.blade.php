@extends('layouts.admin.app')
@section('title', 'Data Tindak Lanjut')
@section('content')
    {{-- start content --}}
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap px-4">
            <div class="mb-3 mb-lg-0">
                <h4 class="display-3 text-black text-center">Data Tindak Lanjut</h4>
                <h6 class="section-title bg-white text-center text-primary px-3">
                    List data tindak lanjut pengaduan
                </h6>
            </div>
        </div>
    </div>

    {{-- Pesan Sukses --}}
    @if (session('success'))
        <div class="alert alert-success mx-4">{!! session('success') !!}</div>
    @endif

    {{-- BAR ATAS: PAGINATE + SEARCH + CLEAR + TAMBAH --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap px-4 mb-4">

        {{-- Pagination kiri --}}
        <div class="mb-2">
            {{ $dataTindakLanjut->links('pagination::bootstrap-5') }}
        </div>

        {{-- Search + Clear --}}
        <form method="GET" action="{{ route('tindaklanjut.index') }}" class="d-flex mb-2">

            <div class="col-md-7">
                <div class="input-group">
                    <input type="text"
                        name="search"
                        class="form-control"
                        placeholder="Search...."
                        value="{{ request('search') }}">

                    <button type="submit" class="btn-search">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <a href="{{ route('tindaklanjut.index') }}" class="btn btn-outline-secondary w-100">
                Clear Filter
            </a>
        </form>

        {{-- Tambah Tindak Lanjut --}}
        <div class="mb-2">
            <a href="{{ route('tindaklanjut.create') }}" class="btn btn-success text-white">
                <i class="fas fa-plus-circle me-1"></i> Tambah Tindak Lanjut
            </a>
        </div>

    </div>
    {{-- END BAR ATAS --}}

    {{-- Card Layout --}}
    <div class="container-fluid py-4 px-4">
        <div class="row g-3 justify-content-start">
            @forelse ($dataTindakLanjut as $item)
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="course-item bg-light shadow-sm rounded-3 h-100">
                        <div class="text-center p-4 pb-0">
                            <h5 class="mb-2 text-dark fw-bold">Petugas: {{ $item->petugas }}</h5>

                            <div class="mb-2">
                                <small class="badge bg-primary text-white">
                                    ID Pengaduan : {{ $item->pengaduan->judul ?? '-' }}
                                </small>
                            </div>

                            <p class="mb-1 text-muted">Aksi:
                                <strong>{{ $item->aksi }}</strong>
                            </p>

                            <p class="mb-1 text-muted">Catatan:
                                <strong>{{ $item->catatan ?? '-' }}</strong>
                            </p>
                        </div>

                        {{-- Button Edit & Delete --}}
                        <div class="d-flex justify-content-center align-items-center gap-3 py-3 border-top">

                            {{-- EDIT --}}
                            <a href="{{ route('tindaklanjut.edit', $item->tindak_id) }}"
                                class="btn btn-sm btn-primary px-3"
                                style="border-radius: 30px;">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>

                            {{-- DETAIL (TENGAH) --}}
                            <a href="{{ route('tindaklanjut.show', $item->tindak_id) }}"
                                class="btn btn-primary btn-sm mb-1"
                                style="border-radius: 50%; width:45px; height:45px; display:flex; justify-content:center; align-items:center;">
                                    <i class="fas fa-eye"></i>
                            </a>

                            {{-- DELETE --}}
                            <form action="{{ route('tindaklanjut.destroy', $item->tindak_id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus data tindak lanjut ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-danger px-3"
                                        style="border-radius: 30px;">
                                    <i class="fas fa-trash-alt me-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center mt-4">
                    <p class="text-muted">Belum ada data tindak lanjut yang terdaftar.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
