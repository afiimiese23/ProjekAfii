@extends('layouts.admin.app')
@section('title', 'User')
@section('content')
    {{-- start content --}}
    <div class="py-4">
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h4 class="display-3 text-black text-center">Data User</h4>
                <h6 class="section-title bg-white text-center text-primary px-3">List user yang telah terdaftar</h6>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{!! session('success') !!}</div>
    @endif

    {{-- BAR ATAS --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap px-4 mb-4">

        <div class="mb-2">
            {{ $dataUser->links('pagination::simple-bootstrap-5') }}
        </div>

        <form method="GET" action="{{ route('user.index') }}" class="d-flex mb-2">
            <div class="col-md-7">
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                        placeholder="Search...." value="{{ request('search') }}">

                    <button type="submit" class="btn-search">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>

            <a href="{{ route('user.index') }}" class="btn btn-outline-secondary w-100">
                Clear Filter
            </a>
        </form>

        <div class="mb-2">
            <a href="{{ route('user.create') }}" class="btn btn-success text-white">
                <i class="fas fa-plus-circle me-1"></i> Tambah User
            </a>
        </div>

    </div>
    {{-- END BAR ATAS --}}

    <div class="row g-3 justify-content-start px-4">
        @forelse ($dataUser as $item)

            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="course-item bg-light shadow-sm rounded-3 h-100">

                    <div class="text-center p-4 pb-0">
                        {{-- FOTO PROFILE --}}
                        @if ($item->profile_picture)
                            <img src="{{ Storage::url($item->profile_picture) }}" 
                                 alt="{{ $item->name }}'s Profile Picture"
                                 class="rounded-circle mb-3"
                                 width="80" height="80" style="object-fit: cover;">
                        @else
                            <img src="{{ asset('path/to/default/avatar.png') }}"
                                 alt="Default Avatar"
                                 class="rounded-circle mb-3"
                                 width="80" height="80" style="object-fit: cover;">
                        @endif

                        <h5 class="mb-2 text-dark fw-bold">{{ $item->name }}</h5>

                        {{-- EMAIL --}}
                        <div class="mb-2">
                            <small class="badge bg-primary text-white">
                                {{ $item->email }}
                            </small>
                        </div>

                        {{-- ROLE (LOGIKA SAMA KAYAK PUNYA TEMAN) --}}
                        <p class="text-muted mb-3">
                            Role: <strong>{{ $item->role }}</strong>
                        </p>
                    </div>

                    {{-- BUTTON --}}
                    <div class="d-flex border-top">
                        <small class="flex-fill text-center border-end py-2">
                            <a href="{{ route('user.edit', $item->id) }}"
                               class="btn btn-sm btn-primary px-3 border-end"
                               style="border-radius: 30px 0 0 30px;">
                                <i class="fas fa-edit me-1"></i> Edit
                            </a>
                        </small>

                        <small class="flex-fill text-center py-2">
                            <form action="{{ route('user.destroy', $item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="btn btn-sm btn-danger px-3"
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
                <p class="text-muted">Belum ada user yang terdaftar.</p>
            </div>
        @endforelse
    </div>

@endsection
