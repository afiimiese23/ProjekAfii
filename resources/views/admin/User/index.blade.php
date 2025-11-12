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
            <div>
                <a href="{{ route('user.create') }}" class="btn btn-success text-white">
                    <i class="fas fa-plus-circle me-1"></i> Tambah user
                </a>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{!! session('success') !!}</div>
    @endif

    <!-- Card Layout -->
    <div class="container-xxl py-4">
        <div class="container">
            <div class="row g-4 justify-content-center">
                @forelse ($dataUser as $item)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="course-item bg-light shadow-sm rounded-3">
                            <div class="text-center p-4 pb-0">
                                <h5 class="mb-2 text-dark fw-bold">{{ $item->name }}</h5>
                                <div class="mb-2">
                                    <small class="badge bg-primary text-white">Email: {{ $item->email }}</small>
                                </div>
                                <p class="mb-3 text-muted">Password: <strong>{{ strlen($item->password) > 10 ? substr($item->password, 0, 10) . '...' : $item->password }}</strong></p>
                            </div>

                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2">
                                    <a href="{{ route('user.edit', $item->id) }}" class="btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                </small>
                                <small class="flex-fill text-center py-2">
                                    <form action="{{ route('user.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger px-3" style="border-radius: 0 30px 30px 0;">
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
        </div>
    </div>
    <!-- End Card Layout -->
@endsection
