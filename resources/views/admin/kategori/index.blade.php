@extends('layouts.admin.app')
@section('title', 'Kategori Pengaduan')
@section('content')
    {{-- start content --}}
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap px-4">
            <div class="mb-3 mb-lg-0">
                <h4 class="display-3 text-black text-center">Data Kategori Pengaduan</h4>
                <h6 class="section-title bg-white text-center text-primary px-3">
                    List kategori pengaduan yang telah terdaftar
                </h6>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success mx-4">{!! session('success') !!}</div>
    @endif

    {{-- BAR ATAS: PAGINATE + SEARCH + CLEAR + TAMBAH KATEGORI --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap px-4 mb-4">

        {{-- Pagination kiri --}}
        <div class="mb-2">
            {{ $dataKategori->links('pagination::bootstrap-5') }}
        </div>

        {{-- Search + Clear --}}
        <form method="GET" action="{{ route('kategori.index') }}" class="d-flex mb-2">

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
            <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary w-100">
                Clear Filter
            </a>
        </form>

        {{-- Tambah Kategori --}}
        <div class="mb-2">
            <a href="{{ route('kategori.create') }}" class="btn btn-success text-white">
                <i class="fas fa-plus-circle me-1"></i> Tambah Kategori
            </a>
        </div>

    </div>
    {{-- END BAR ATAS --}}

    <!-- Card Layout Full Width -->
    <div class="container-fluid py-4 px-4">
        <div class="row g-3 justify-content-start">
            @forelse ($dataKategori as $item)
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="course-item bg-light shadow-sm rounded-3 h-100">
                        <div class="text-center p-4 pb-0">
                            <h5 class="mb-2 text-dark fw-bold">{{ $item->nama }}</h5>
                            <div class="mb-2">
                                <small class="badge bg-primary text-white">SLA: {{ $item->sla_hari }} Hari</small>
                            </div>
                            <p class="mb-3 text-muted">Prioritas: <strong>{{ $item->prioritas }}</strong></p>
                        </div>

                        <div class="d-flex border-top">
                            <small class="flex-fill text-center border-end py-2">
                                <a href="{{ route('kategori.edit', $item->kategori_id) }}" 
                                   class="btn btn-sm btn-primary px-3 border-end" 
                                   style="border-radius: 30px 0 0 30px;">
                                    <i class="fas fa-edit me-1"></i> Edit
                                </a>
                            </small>
                            <small class="flex-fill text-center py-2">
                                <form action="{{ route('kategori.destroy', $item->kategori_id) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger px-3" 
                                            style="border-radius: 0 30px 30px 0;">
                                        <i class="fas fa-trash-alt me-1"></i> Hapus
                                    </button>
                                </form>
                            </small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center">
                    <p class="text-muted">Belum ada kategori yang terdaftar.</p>
                </div>
            @endforelse
        </div>
    </div>
    <!-- End Card Layout Full Width -->
@endsection
