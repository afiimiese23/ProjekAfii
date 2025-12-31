<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top">
    
    {{-- Brand --}}
    <a href="{{ route('dashboard') }}" 
       class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h2 class="m-0 text-primary">
            <img src="{{ asset('assets-admin/img/logo.png') }}" alt="Logo" height="70" class="d-inline-block align-middle"> @yield('title')
        </h2>
    </a>

    {{-- Toggler --}}
    <button class="navbar-toggler me-4" 
            type="button" 
            data-bs-toggle="collapse" 
            data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    {{-- Menu --}}
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto align-items-center px-4 px-lg-0">

            {{-- Home --}}
            <a href="{{ route('dashboard') }}"
               class="nav-item nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Home
            </a>

            {{-- User (Admin Only) --}}
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('user.index') }}"
                    class="nav-item nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
                        User
                    </a>
                @endif
            @endauth

            {{-- Warga --}}
            <a href="{{ route('warga.index') }}"
               class="nav-item nav-link {{ request()->routeIs('warga.*') ? 'active' : '' }}">
                Warga
            </a>

            {{-- Pengaduan --}}
            <div class="nav-item dropdown">
                <a href="#"
                   class="nav-link dropdown-toggle {{ request()->routeIs('kategori.*','pengaduan.*','tindaklanjut.*','penilaianlayanan.*') ? 'active' : '' }}"
                   data-bs-toggle="dropdown">
                    Pengaduan
                </a>

                <div class="dropdown-menu fade-down m-0">
                    <a href="{{ route('pengaduan.index') }}" class="dropdown-item">Data Pengaduan</a>
                    <a href="{{ route('penilaianlayanan.index') }}" class="dropdown-item">Penilaian Layanan</a>
                    {{-- ADMIN ONLY --}}
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('kategori.index') }}" class="dropdown-item">
                                Kategori Pengaduan
                            </a>

                            <a href="{{ route('tindaklanjut.index') }}" class="dropdown-item">
                                Tindak Lanjut
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            {{-- User Login --}}
            @if(Auth::check())
            <div class="nav-item dropdown">
                <a href="#"
                   class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                   data-bs-toggle="dropdown">

                    <span>{{ Auth::user()->name }}</span>
                    
                    <img src="{{ Auth::user()->profile_picture 
                                ? asset('storage/' . Auth::user()->profile_picture) 
                                : asset('default-avatar.png') }}"
                         class="rounded-circle"
                         width="35" height="35">
                </a>

                <div class="dropdown-menu dropdown-menu-end fade-down m-0">
                    <span class="dropdown-item-text text-muted small">
                        Last login: {{ session('last_login') }}
                    </span>

                    <div class="dropdown-divider"></div>

                    <a href="#" class="dropdown-item">
                        <i class="bi bi-gear me-2"></i> Settings
                    </a>

                    <a href="{{ route('auth.logout') }}" 
                       class="dropdown-item text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </div>
            </div>
            @else
                <a href="{{ route('auth') }}" class="nav-item nav-link">Login</a>
            @endif

        </div>
    </div>
</nav>
<!-- Navbar End -->
