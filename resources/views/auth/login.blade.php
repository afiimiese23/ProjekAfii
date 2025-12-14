@extends('layouts.auth.app')
@section('content')
    <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
        <div class="text-center text-md-center mb-4 mt-md-0">
            <h1 class="mb-0 h3" style="color: #25C3D2;">Sign in to our platform</h1>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('auth.login') }}" method="POST" class="mt-4">
            @csrf

            <!-- Email -->
            <div class="form-group mb-4">
                <label for="email">Your Email</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-envelope" viewBox="0 0 16 16">
                            <path
                                d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v.217l-8 4.5-8-4.5V4z" />
                            <path
                                d="M0 6.383v5.634A2 2 0 0 0 2 14h12a2 2 0 0 0 2-2V6.383l-7.555 4.244a1 1 0 0 1-.89 0L0 6.383z" />
                        </svg>
                    </span>

                    <input type="email" class="form-control" placeholder="example@company.com"
                        id="email" name="email" required value="{{ old('email') }}">
                </div>
            </div>


            <!-- Password -->
            <div class="form-group mb-4">
                <label for="password">Your Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-lock" viewBox="0 0 16 16">
                            <path
                                d="M8 1a3 3 0 0 0-3 3v3h6V4a3 3 0 0 0-3-3zm4 6V4a4 4 0 1 0-8 0v3a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                        </svg>
                    </span>

                    <input type="password" class="form-control" placeholder="Password"
                        id="password" name="password" required>
                </div>
            </div>


            <!-- Submit -->
            <div class="d-grid">
                <button type="submit" class="btn btn-gray-800">Sign in</button>
            </div>
        </form>

        <div class="mt-3 mb-4 text-center">
            <span class="fw-normal">or login with</span>
        </div>
        <div class="d-flex justify-content-center my-4">
            <!-- Facebook -->
            <a href="#" class="btn btn-icon-only btn-pill btn-outline-gray-500 me-2" title="Login with Facebook">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-facebook" viewBox="0 0 16 16">
                    <path
                        d="M8.94 6.72H7.5V5.47c0-.38.25-.47.42-.47h.96V3.02L7.52 3c-1.65 0-2.02 1.22-2.02 2v1.72H4.5v1.77H5.5v4.53h2V8.49h1.34l.21-1.77z" />
                </svg>
            </a>

            <!-- Google -->
            <a href="#" class="btn btn-icon-only btn-pill btn-outline-gray-500 me-2" title="Login with Google">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-google" viewBox="0 0 16 16">
                    <path
                        d="M8.159 6.504v2.828h3.906c-.171.999-1.172 2.93-3.906 2.93-2.351 0-4.267-1.927-4.267-4.262 0-2.336 1.916-4.263 4.267-4.263 1.338 0 2.232.568 2.744 1.06l1.873-1.8C11.684 1.552 10.092.75 8.159.75 4.437.75 1.375 3.803 1.375 7.524c0 3.72 3.062 6.773 6.784 6.773 3.918 0 6.508-2.757 6.508-6.641 0-.444-.048-.782-.108-1.152H8.159z" />
                </svg>
            </a>

            <!-- Apple -->
            <a href="#" class="btn btn-icon-only btn-pill btn-outline-gray-500 me-2" title="Login with Apple">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-apple" viewBox="0 0 16 16">
                    <path
                        d="M8.066 2.247c.01-.761.327-1.507.853-2.052A2.57 2.57 0 0 1 10.78 0a2.63 2.63 0 0 1-2.697 2.247zm2.25 3.037c-.484-.605-1.162-.915-1.845-.915-.688 0-1.163.313-1.646.313-.498 0-.995-.313-1.647-.313C3.935 4.37 2.5 5.7 2.5 8.036c0 2.432 1.906 5.2 3.513 5.2.624 0 .878-.313 1.644-.313.752 0 .99.313 1.643.313 1.285 0 2.638-1.612 3.225-3.186-1.911-.759-2.106-3.528-.209-4.766z" />
                </svg>
            </a>

            <!-- Github -->
            <a href="#" class="btn btn-icon-only btn-pill btn-outline-gray-500" title="Login with Github">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                    class="bi bi-github" viewBox="0 0 16 16">
                    <path
                        d="M8 0C3.58 0 0 3.58 0 8a8 8 0 0 0 5.47 7.59c.4.07.55-.17.55-.38v-1.33c-2.23.48-2.7-1.07-2.7-1.07-.36-.93-.88-1.18-.88-1.18-.72-.5.06-.49.06-.49.8.06 1.22.82 1.22.82.71 1.21 1.87.86 2.33.66.07-.52.28-.86.51-1.06-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.13 0 0 .67-.21 2.2.82a7.73 7.73 0 0 1 4 0c1.52-1.03 2.2-.82 2.2-.82.44 1.11.16 1.93.08 2.13.51.56.82 1.28.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48v2.19c0 .21.15.45.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8z" />
                </svg>
            </a>
        </div>
        <div class="d-flex justify-content-center align-items-center mt-4">
            <span class="fw-normal">
                Not registered?
                <a href="./sign-up.html" class="fw-bold">Create account</a>
            </span>
        </div>
    </div>
@endsection
