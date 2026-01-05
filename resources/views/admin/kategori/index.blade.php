@extends('layouts.admin.app')
@section('title', 'Kategori Pengaduan')
@section('content')

<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap px-4">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Data Kategori Pengaduan</h4>
            <h6 class="section-title bg-white text-primary px-3">
                List kategori pengaduan yang telah terdaftar
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
        {{ $dataKategori->links('pagination::bootstrap-5') }}
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('kategori.index') }}" class="d-flex mb-2 gap-2">
        <input type="text" name="search" class="form-control"
               placeholder="Search kategori..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
        <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">
            Clear
        </a>
    </form>

    {{-- Tambah --}}
    <div class="mb-2">
        <a href="{{ route('kategori.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle me-1"></i> Tambah Kategori
        </a>
    </div>
</div>
{{-- END BAR ATAS --}}

<div class="container-fluid px-4">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-primary text-white fw-semibold">
            <i class="fas fa-table me-2"></i> Tabel Kategori Pengaduan
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Kategori</th>
                            <th width="15%">SLA (Hari)</th>
                            <th width="15%">Prioritas</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataKategori as $index => $item)
                            <tr>
                                <td class="text-center">
                                    {{ $dataKategori->firstItem() + $index }}
                                </td>
                                <td>{{ $item->nama }}</td>
                                <td class="text-center">
                                    <span class="badge bg-info">
                                        {{ $item->sla_hari }} Hari
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($item->prioritas == 'Tinggi')
                                        <span class="badge bg-danger">Tinggi</span>
                                    @elseif ($item->prioritas == 'Sedang')
                                        <span class="badge bg-warning text-dark">Sedang</span>
                                    @else
                                        <span class="badge bg-success">Rendah</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('kategori.edit', $item->kategori_id) }}"
                                       class="btn btn-sm btn-primary me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('kategori.destroy', $item->kategori_id) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Belum ada kategori yang terdaftar.
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
