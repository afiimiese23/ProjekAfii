@extends('layouts.admin.app')
@section('title', 'Data User')
@section('content')

{{-- HEADER --}}
<div class="py-4">
    <div class="d-flex justify-content-between w-100 flex-wrap px-4">
        <div>
            <h4 class="display-3 text-black">Data User</h4>
            <h6 class="section-title bg-white text-primary px-3">
                List user yang telah terdaftar
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
        {{ $dataUser->links('pagination::bootstrap-5') }}
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('user.index') }}" class="d-flex gap-2 mb-2">
        <input type="text"
               name="search"
               class="form-control"
               placeholder="Search user..."
               value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
        <a href="{{ route('user.index') }}" class="btn btn-outline-secondary">
            Clear
        </a>
    </form>

    {{-- Tambah --}}
    <div class="mb-2">
        <a href="{{ route('user.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle me-1"></i> Tambah User
        </a>
    </div>

</div>
{{-- END BAR ATAS --}}

{{-- TABLE --}}
<div class="container-fluid px-4">
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header bg-primary text-white fw-semibold">
            <i class="fas fa-table me-2"></i> Tabel Data User
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th width="10%">Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th width="15%">Role</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($dataUser as $index => $item)
                            <tr>
                                <td class="text-center">
                                    {{ $dataUser->firstItem() + $index }}
                                </td>

                                {{-- FOTO --}}
                                <td class="text-center">
                                    @if ($item->profile_picture)
                                        <img src="{{ Storage::url($item->profile_picture) }}"
                                             class="rounded-circle"
                                             width="40" height="40"
                                             style="object-fit: cover;">
                                    @else
                                        <img src="{{ asset('assets/images/default-avatar.png') }}"
                                             class="rounded-circle"
                                             width="40" height="40">
                                    @endif
                                </td>

                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>

                                {{-- ROLE --}}
                                <td class="text-center">
                                    @if ($item->role == 'admin')
                                        <span class="badge bg-danger">Admin</span>
                                    @elseif ($item->role == 'mitra')
                                        <span class="badge bg-warning text-dark">Mitra</span>
                                    @else
                                        <span class="badge bg-success">Pelanggan</span>
                                    @endif
                                </td>

                                {{-- AKSI --}}
                                <td class="text-center">
                                    <a href="{{ route('user.edit', $item->id) }}"
                                       class="btn btn-sm btn-primary me-1">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{ route('user.destroy', $item->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus user ini?')">
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
                                    Belum ada user yang terdaftar.
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
