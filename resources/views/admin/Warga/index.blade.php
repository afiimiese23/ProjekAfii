@php
    use Illuminate\Support\Str;
@endphp

@extends('layouts.admin.app')
@section('title', 'Data Warga')
@section('content')

{{-- HEADER --}}
<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap px-4">
        <div>
            <h4 class="display-3 text-black">Data Warga</h4>
            <h6 class="section-title bg-white text-primary px-3">
                List data warga yang telah terdaftar
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
        {{ $dataWarga->links('pagination::bootstrap-5') }}
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('warga.index') }}" class="d-flex gap-2 mb-2">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Search..."
               value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
        <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary">
            Clear
        </a>
    </form>

    {{-- Tambah --}}
    <div class="mb-2">
        <a href="{{ route('warga.create') }}" class="btn btn-success text-white">
            <i class="fas fa-plus-circle me-1"></i> Tambah Data Warga
        </a>
    </div>

</div>
{{-- END BAR ATAS --}}

{{-- TABLE --}}
<div class="container-fluid px-4">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-primary text-white fw-semibold">
            <i class="fas fa-users me-2"></i> Tabel Data Warga
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th width="4%">No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>No KTP</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Pekerjaan</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th width="18%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($dataWarga as $index => $item)
                            <tr>
                                <td class="text-center">
                                    {{ $dataWarga->firstItem() + $index }}
                                </td>

                                {{-- FOTO --}}
                                <td class="text-center">
                                    @if ($item->profile_picture)
                                        @if (Str::startsWith($item->profile_picture, ['http://', 'https://']))
                                            <img src="{{ $item->profile_picture }}"
                                                 class="rounded-circle"
                                                 width="45" height="45"
                                                 style="object-fit:cover;">
                                        @else
                                            <img src="{{ asset('storage/' . $item->profile_picture) }}"
                                                 class="rounded-circle"
                                                 width="45" height="45"
                                                 style="object-fit:cover;">
                                        @endif
                                    @else
                                        <img src="{{ asset('assets/images/default-avatar.png') }}"
                                             class="rounded-circle"
                                             width="45" height="45"
                                             style="object-fit:cover;">
                                    @endif
                                </td>

                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->no_ktp }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->agama }}</td>
                                <td>{{ $item->pekerjaan }}</td>
                                <td>{{ $item->phone ?? '-' }}</td>
                                <td>{{ $item->email }}</td>

                                {{-- ACTION --}}
                                <td class="text-center">
                                    <a href="{{ route('warga.show', $item->warga_id) }}"
                                       class="btn btn-sm btn-info me-1 text-white">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('warga.edit', $item->warga_id) }}"
                                       class="btn btn-sm btn-primary me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('warga.destroy', $item->warga_id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data warga ini?')">
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
                                <td colspan="10" class="text-center text-muted">
                                    Belum ada data warga yang terdaftar.
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
