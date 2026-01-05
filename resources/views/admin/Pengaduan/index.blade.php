@extends('layouts.admin.app')
@section('title', 'Pengaduan Warga')
@section('content')

<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap px-4">
        <div class="mb-3 mb-lg-0">
            <h4 class="display-3 text-black">Data Pengaduan Warga</h4>
            <h6 class="section-title bg-white text-primary px-3">
                List pengaduan yang telah dibuat warga
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
        {{ $pengaduan->links('pagination::bootstrap-5') }}
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('pengaduan.index') }}" class="d-flex mb-2 gap-2">
        <input type="text" name="search" class="form-control"
               placeholder="Search pengaduan..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
        <a href="{{ route('pengaduan.index') }}" class="btn btn-outline-secondary">
            Clear
        </a>
    </form>

    {{-- Tambah --}}
    <div class="mb-2">
        <a href="{{ route('pengaduan.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle me-1"></i> Tambah Pengaduan
        </a>
    </div>
</div>
{{-- END BAR ATAS --}}

<div class="container-fluid px-4">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-primary text-white fw-semibold">
            <i class="fas fa-table me-2"></i> Tabel Pengaduan Warga
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Judul</th>
                            <th>Warga</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th width="20%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengaduan as $index => $item)
                            <tr>
                                <td class="text-center">{{ $pengaduan->firstItem() + $index }}</td>
                                <td>{{ $item->judul }}</td>
                                <td>{{ $item->warga->nama }}</td>
                                <td>{{ $item->kategori->nama }}</td>
                                <td class="text-center">
                                    @if ($item->status == 'baru')
                                        <span class="badge bg-danger">Baru</span>
                                    @elseif ($item->status == 'diproses')
                                        <span class="badge bg-warning text-dark">Diproses</span>
                                    @else
                                        <span class="badge bg-success">Selesai</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {{-- EDIT --}}
                                    @auth
                                        @if(Auth::user()->role === 'admin')
                                            <a href="{{ route('pengaduan.edit', $item->id) }}"
                                               class="btn btn-sm btn-primary me-1">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
                                    @endauth

                                    {{-- DETAIL --}}
                                    <a href="{{ route('pengaduan.show', $item->id) }}"
                                       class="btn btn-sm btn-info me-1">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    {{-- DELETE --}}
                                    @auth
                                        @if(Auth::user()->role === 'admin')
                                            <form action="{{ route('pengaduan.destroy', $item->id) }}"
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
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
                                    Belum ada pengaduan yang terdaftar.
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
