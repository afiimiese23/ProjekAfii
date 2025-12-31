@extends('layouts.auth.app')

@section('content')
<div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">

    <div class="text-center text-md-center mb-4 mt-md-0">
        <h1 class="mb-0 h3" style="color: #25C3D2;">Create your account</h1>
    </div>

    {{-- Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('auth.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
        @csrf

        <!-- Name -->
        <div class="form-group mb-4">
            <label for="name">Your Name</label>
            <div class="input-group">
                <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path d="M14 14s-1-4-6-4-6 4-6 4 1 1 6 1 6-1 6-1z"/>
                    </svg>
                </span>
                <input type="text" class="form-control"
                       name="name" id="name"
                       value="{{ old('name') }}" required>
            </div>
        </div>

        <!-- Email -->
        <div class="form-group mb-4">
            <label for="email">Your Email</label>
            <div class="input-group">
                <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-envelope" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v.217l-8 4.5-8-4.5V4z"/>
                        <path d="M0 6.383v5.634A2 2 0 0 0 2 14h12a2 2 0 0 0 2-2V6.383l-7.555 4.244a1 1 0 0 1-.89 0L0 6.383z"/>
                    </svg>
                </span>
                <input type="email" class="form-control"
                       name="email" id="email"
                       value="{{ old('email') }}" required>
            </div>
        </div>

        <!-- Password -->
        <div class="form-group mb-4">
            <label for="password">Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-lock" viewBox="0 0 16 16">
                        <path d="M8 1a3 3 0 0 0-3 3v3h6V4a3 3 0 0 0-3-3z"/>
                        <path d="M3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2H3z"/>
                    </svg>
                </span>
                <input type="password" class="form-control"
                       name="password" id="password" required>
            </div>
        </div>

        <!-- Password Confirmation -->
        <div class="form-group mb-4">
            <label for="password_confirmation">Confirm Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-shield-lock" viewBox="0 0 16 16">
                        <path d="M5.072.56a1 1 0 0 1 .856 0l4 2A1 1 0 0 1 10.5 3.5v4.5c0 3.6-2.6 5.3-4.3 6.1a.7.7 0 0 1-.4 0C4.1 13.3 1.5 11.6 1.5 8V3.5a1 1 0 0 1 .572-.94l3-1.5z"/>
                    </svg>
                </span>
                <input type="password" class="form-control"
                       name="password_confirmation" required>
            </div>
        </div>

        <!-- Role -->
        <div class="form-group mb-4">
            <label>Role</label>
            <select name="role" class="form-select" required>
                <option value="">-- Select Role --</option>
                <option value="admin" {{ old('role')=='admin'?'selected':'' }}>Admin</option>
                <option value="pelanggan" {{ old('role')=='pelanggan'?'selected':'' }}>Pelanggan</option>
                <option value="mitra" {{ old('role')=='mitra'?'selected':'' }}>Mitra</option>
            </select>
        </div>

        <!-- Profile Picture -->
        <div class="form-group mb-4">
            <label>Profile Picture (Optional)</label>
            <input type="file" name="profile_picture" class="form-control">
        </div>

        <!-- Submit -->
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">
                Create Account
            </button>
        </div>
    </form>

    <div class="d-flex justify-content-center align-items-center mt-4">
        <span class="fw-normal">
            Already have an account?
            <a href="{{ route('login') }}" class="fw-bold">Sign in</a>
        </span>
    </div>

</div>
@endsection
