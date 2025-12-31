@extends('layouts.admin.app')
@section('title', 'Penilaian Layanan')
@section('content')
    {{-- start content --}}
    <div class="py-4">
        <div class="d-flex justify-content-between align-items-center w-100 flex-wrap text-center text-md-start">
            <div class="mb-3 mb-lg-0">
                <h4 class="display-3 text-black text-center">Data Penilaian Layanan</h4>
                <h6 class="section-title bg-white text-center text-primary px-3">
                    List penilaian layanan dari pengaduan
                </h6>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{!! session('success') !!}</div>
    @endif

    {{-- BAR ATAS --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap px-4 mb-4">

        <div class="mb-2">
            {{ $dataPenilaianLayanan->links('pagination::simple-bootstrap-5') }}
        </div>

        <form method="GET" action="{{ route('penilaianlayanan.index') }}" class="d-flex mb-2">
            <div class="col-md-7">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                        placeholder="Search...." value="{{ request('search') }}">

                    <button type="submit" class="btn-search">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <a href="{{ route('penilaianlayanan.index') }}" class="btn btn-outline-secondary w-100">
                Clear Filter
            </a>
        </form>

        <div class="mb-2">
            <a href="{{ route('penilaianlayanan.create') }}" class="btn btn-success text-white">
                <i class="fas fa-plus-circle me-1"></i> Tambah Penilaian
            </a>
        </div>

    </div>
    {{-- END BAR ATAS --}}

    <div class="row g-3 justify-content-start px-4">
        @forelse ($dataPenilaianLayanan as $item)

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="course-item bg-light shadow-sm rounded-3 h-100">

                    <div class="text-center p-4 pb-0">

                        <h5 class="mb-2 text-dark fw-bold">
                            Penilaian #{{ $item->penilaian_id }}
                        </h5>

                        <div class="mb-2">
                            <small class="badge bg-primary text-white">
                                 Pengaduan : {{ $item->pengaduan->judul ?? '-' }}
                            </small>
                        </div>

                        <p class="text-muted mb-1">
                            Rating:
                            <strong>{{ $item->rating }}</strong>
                        </p>

                        <p class="text-muted mb-3">
                            Komentar:
                            <strong>{{ $item->komentar ?? '-' }}</strong>
                        </p>
                    </div>

                    {{-- BUTTON --}}
                    <div class="d-flex border-top">
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <small class="flex-fill text-center border-end py-2">
                                    <a href="{{ route('penilaianlayanan.edit', $item->penilaian_id) }}"
                                    class="btn btn-sm btn-primary px-3 border-end"
                                    style="border-radius: 30px 0 0 30px;">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                </small>
                            @endif
                        @endauth

                        @auth
                            @if(Auth::user()->role === 'admin')
                                <small class="flex-fill text-center py-2">
                                    <form action="{{ route('penilaianlayanan.destroy', $item->penilaian_id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus penilaian ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger px-3"
                                                style="border-radius: 0 30px 30px 0;">
                                            <i class="fas fa-trash-alt me-1"></i> Hapus
                                        </button>
                                    </form>
                                </small>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>

        @empty
            <div class="text-center">
                <p class="text-muted">Belum ada data penilaian layanan.</p>
            </div>
        @endforelse
    </div>

@endsection
