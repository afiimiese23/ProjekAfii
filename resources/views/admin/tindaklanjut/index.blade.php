@extends('layouts.admin.app')
@section('title', 'Data Tindak Lanjut')
@section('content')

{{-- HEADER --}}
<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap px-4">
        <div>
            <h4 class="display-3 text-black">Data Tindak Lanjut</h4>
            <h6 class="section-title bg-white text-primary px-3">
                List data tindak lanjut pengaduan
            </h6>
        </div>
    </div>
</div>

{{-- SUCCESS MESSAGE --}}
@if (session('success'))
    <div class="alert alert-success mx-4">
        {!! session('success') !!}
    </div>
@endif

{{-- BAR ATAS --}}
<div class="d-flex justify-content-between align-items-center flex-wrap px-4 mb-4">

    {{-- Pagination --}}
    <div class="mb-2">
        {{ $dataTindakLanjut->links('pagination::bootstrap-5') }}
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('tindaklanjut.index') }}" class="d-flex gap-2 mb-2">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Search..."
               value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
        <a href="{{ route('tindaklanjut.index') }}" class="btn btn-outline-secondary">
            Clear
        </a>
    </form>

    {{-- Tambah --}}
    <div class="mb-2">
        <a href="{{ route('tindaklanjut.create') }}" class="btn btn-success text-white">
            <i class="fas fa-plus-circle me-1"></i> Tambah Tindak Lanjut
        </a>
    </div>

</div>
{{-- END BAR ATAS --}}

{{-- TABLE --}}
<div class="container-fluid px-4">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-primary text-white fw-semibold">
            <i class="fas fa-table me-2"></i> Tabel Tindak Lanjut
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>Petugas</th>
                            <th>Judul Pengaduan</th>
                            <th>Aksi</th>
                            <th>Catatan</th>
                            <th width="18%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($dataTindakLanjut as $index => $item)
                            <tr>
                                <td class="text-center">
                                    {{ $dataTindakLanjut->firstItem() + $index }}
                                </td>

                                <td>{{ $item->petugas }}</td>

                                <td>
                                    {{ $item->pengaduan->judul ?? '-' }}
                                </td>

                                <td>{{ $item->aksi }}</td>

                                <td>{{ $item->catatan ?? '-' }}</td>

                                {{-- ACTION --}}
                                <td class="text-center">
                                    <a href="{{ route('tindaklanjut.show', $item->tindak_id) }}"
                                       class="btn btn-sm btn-info me-1 text-white">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('tindaklanjut.edit', $item->tindak_id) }}"
                                       class="btn btn-sm btn-primary me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('tindaklanjut.destroy', $item->tindak_id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data tindak lanjut ini?')">
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
                                <td colspan="6" class="text-center text-muted">
                                    Belum ada data tindak lanjut yang terdaftar.
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
