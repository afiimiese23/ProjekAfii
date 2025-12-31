@php
    use Illuminate\Support\Str;
@endphp
@extends('layouts.admin.app')
@section('title', 'Data Warga')
@section('content')

    {{-- start content --}}
    <div class="py-4">
        <div class="d-flex justify-content-between align-items-center w-100 flex-wrap text-center text-md-start">
            <div class="mb-3 mb-lg-0">
                <h4 class="display-3 text-black text-center">Data Warga</h4>
                <h6 class="section-title bg-white text-center text-primary px-3">
                    List data warga yang telah terdaftar
                </h6>
            </div>
        </div>
    </div>

    {{-- Pesan Sukses --}}
    @if (session('success'))
        <div class="alert alert-success mx-4">{!! session('success') !!}</div>
    @endif

    {{-- BAR ATAS: PAGINATE + SEARCH + CLEAR + TAMBAH WARGA --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap px-4 mb-4">

        {{-- Pagination kiri --}}
        <div class="mb-2">
            {{ $dataWarga->links('pagination::bootstrap-5') }}
        </div>

        {{-- Search + Clear --}}
        <form method="GET" action="{{ route('warga.index') }}" class="d-flex mb-2">

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
            <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary w-100">
                Clear Filter
            </a>
        </form>

        {{-- Tambah Warga --}}
        <div class="mb-2">
            <a href="{{ route('warga.create') }}" class="btn btn-success text-white">
                <i class="fas fa-plus-circle me-1"></i> Tambah Data Warga
            </a>
        </div>

    </div>
    {{-- END BAR ATAS --}}

    {{-- Card Layout --}}
    <div class="container-fluid py-4 px-4">
        <div class="row g-3 justify-content-start">
            @forelse ($dataWarga as $item)
                <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
                    <div class="course-item bg-light shadow-sm rounded-3 h-100">
                        <div class="text-center p-4 pb-0">
                            {{-- FOTO PROFILE --}}
                            @if ($item->profile_picture)
                                @if (Str::startsWith($item->profile_picture, ['http://', 'https://']))
                                    <img src="{{ $item->profile_picture }}"
                                        class="rounded-circle mb-3"
                                        width="80" height="80"
                                        style="object-fit:cover;">
                                @else
                                    <img src="{{ asset('storage/' . $item->profile_picture) }}"
                                        class="rounded-circle mb-3"
                                        width="80" height="80"
                                        style="object-fit:cover;">
                                @endif
                            @else
                                <img src="{{ asset('assets/images/default-avatar.png') }}"
                                    class="rounded-circle mb-3"
                                    width="80" height="80"
                                    style="object-fit:cover;">
                            @endif

                            {{-- nama --}}
                            <h5 class="mb-2 text-dark fw-bold">{{ $item->nama }}</h5>

                            <div class="mb-2">
                                <small class="badge bg-primary text-white">
                                    No KTP: {{ $item->no_ktp }}
                                </small>
                            </div>

                            <p class="mb-1 text-muted">Jenis Kelamin:
                                <strong>{{ $item->jenis_kelamin }}</strong>
                            </p>

                            <p class="mb-1 text-muted">Agama:
                                <strong>{{ $item->agama }}</strong>
                            </p>

                            <p class="mb-1 text-muted">Pekerjaan:
                                <strong>{{ $item->pekerjaan }}</strong>
                            </p>

                            <p class="mb-1 text-muted">Phone:
                                <strong>{{ $item->phone ?? '-' }}</strong>
                            </p>

                            <p class="mb-3 text-muted">Email:
                                <strong>{{ $item->email }}</strong>
                            </p>
                        </div>

                        {{-- Button Edit & Delete --}}
                        <div class="d-flex justify-content-center align-items-center gap-3 py-3 border-top">

                            {{-- EDIT --}}
                            <a href="{{ route('warga.edit', $item->warga_id) }}"
                                class="btn btn-sm btn-primary px-3"
                                style="border-radius: 30px;">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>

                            {{-- DETAIL (TENGAH) --}}
                            <a href="{{ route('warga.show', $item->warga_id) }}"
                                class="btn btn-primary btn-sm mb-1"
                                style="border-radius: 50%; width:45px; height:45px; display:flex; justify-content:center; align-items:center;">
                                    <i class="fas fa-eye"></i>
                            </a>

                            {{-- DELETE --}}
                            <form action="{{ route('warga.destroy', $item->warga_id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus data warga ini?')">
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
                    <p class="text-muted">Belum ada data warga yang terdaftar.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection