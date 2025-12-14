<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="{{ route('dashboard') }}" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i> @yield ('title') </h2>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ route('dashboard') }}" class="nav-item nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Home</a>
            <a href="{{ route('kategori.index') }}" class="nav-item nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">Kategori</a>
            <a href="{{ route('user.index') }}" class="nav-item nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">User</a>
            <a href="{{ route('warga.index') }}" class="nav-item nav-link {{ request()->routeIs('warga.*') ? 'active' : '' }}">Warga</a>

            <div class="nav-item dropdown">
                @if(Auth::check())
                    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">

                        {{-- Avatar User --}}
                        <img 
                            src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('default-avatar.png') }}"
                            class="rounded-circle me-2"
                            alt="User Avatar"
                            width="32" height="32"
                        >

                        {{-- Nama User --}}
                        <span>{{ Auth::user()->name }}</span>
                    </a>

                    <div class="dropdown-menu fade-down m-0">

                        {{-- Last Login --}}
                        <a href="#" class="dropdown-item d-flex align-items-center">
                            <i class="bi bi-clock-history me-2"></i>
                            {{ session('last_login') }}
                        </a>

                        {{-- Settings --}}
                        <a href="#" class="dropdown-item d-flex align-items-center">
                            <i class="bi bi-gear me-2"></i>
                            Settings
                        </a>

                        <div class="dropdown-divider"></div>

                        {{-- Logout --}}
                        <a href="{{ route('auth.logout') }}" class="dropdown-item d-flex align-items-center text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i>
                            Logout
                        </a>
                    </div>

                @else
                    <a href="{{ route('auth') }}" class="nav-link">Login</a>
                @endif
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->
