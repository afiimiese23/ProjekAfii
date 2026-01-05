@extends('layouts.admin.app')
@section('title', 'Penilaian Layanan')
@section('content')

{{-- HEADER --}}
<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap px-4">
        <div>
            <h4 class="display-3 text-black">Data Penilaian Layanan</h4>
            <h6 class="section-title bg-white text-primary px-3">
                List penilaian layanan dari pengaduan
            </h6>
        </div>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success mx-4">
        {!! session('success') !!}
    </div>
@endif

{{-- BAR ATAS --}}
<div class="d-flex justify-content-between align-items-center flex-wrap px-4 mb-4">

    {{-- Pagination --}}
    <div class="mb-2">
        {{ $dataPenilaianLayanan->links('pagination::simple-bootstrap-5') }}
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('penilaianlayanan.index') }}" class="d-flex gap-2 mb-2">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Search..."
               value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
        <a href="{{ route('penilaianlayanan.index') }}" class="btn btn-outline-secondary">
            Clear
        </a>
    </form>

    {{-- Tambah --}}
    <div class="mb-2">
        <a href="{{ route('penilaianlayanan.create') }}" class="btn btn-success text-white">
            <i class="fas fa-plus-circle me-1"></i> Tambah Penilaian
        </a>
    </div>

</div>
{{-- END BAR ATAS --}}

{{-- TABLE --}}
<div class="container-fluid px-4">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-primary text-white fw-semibold">
            <i class="fas fa-table me-2"></i> Tabel Penilaian Layanan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">ID</th>
                            <th>Judul Pengaduan</th>
                            <th width="10%">Rating</th>
                            <th>Komentar</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($dataPenilaianLayanan as $index => $item)
                            <tr>
                                <td class="text-center">
                                    {{ $dataPenilaianLayanan->firstItem() + $index }}
                                </td>

                                <td class="text-center">
                                    <span class="badge bg-info">
                                        #{{ $item->penilaian_id }}
                                    </span>
                                </td>

                                <td>
                                    {{ $item->pengaduan->judul ?? '-' }}
                                </td>

                                <td class="text-center">
                                    <span class="badge bg-warning text-dark">
                                        {{ $item->rating }}
                                    </span>
                                </td>

                                <td>
                                    {{ $item->komentar ?? '-' }}
                                </td>

                                {{-- AKSI --}}
                                <td class="text-center">
                                    @auth
                                        @if(Auth::user()->role === 'admin')

                                            {{-- EDIT --}}
                                            <a href="{{ route('penilaianlayanan.edit', $item->penilaian_id) }}"
                                               class="btn btn-sm btn-primary me-1">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            {{-- DELETE --}}
                                            <form action="{{ route('penilaianlayanan.destroy', $item->penilaian_id) }}"
                                                  method="POST"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus penilaian ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>

                                        @endif
                                    @endauth
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">
                                    Belum ada data penilaian layanan.
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
