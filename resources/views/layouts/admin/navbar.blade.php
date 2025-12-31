<!-- Navbar Start -->
<nav class="navbar bg-white navbar-light shadow sticky-top px-3 px-lg-5">

    {{-- Brand --}}
    <a href="{{ route('dashboard') }}" 
       class="navbar-brand d-flex align-items-center gap-2">
        <img src="{{ asset('assets-admin/img/logo.png') }}" alt="Logo" height="60">
        <span class="fw-bold text-primary">@yield('title')</span>
    </a>

    {{-- Menu (NO COLLAPSE, NO TOGGLER) --}}
    <div class="navbar-menu ms-auto">
        <div class="navbar-nav align-items-lg-center">

            {{-- Home --}}
            <a href="{{ route('dashboard') }}"
               class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Home
            </a>

            {{-- Admin Only --}}
            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('user.index') }}"
                       class="nav-link {{ request()->routeIs('user.*') ? 'active' : '' }}">
                        User
                    </a>
                @endif
            @endauth

            {{-- Warga --}}
            <a href="{{ route('warga.index') }}"
               class="nav-link {{ request()->routeIs('warga.*') ? 'active' : '' }}">
                Warga
            </a>

            {{-- Pengaduan --}}
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle"
                   data-bs-toggle="dropdown">
                    Pengaduan
                </a>

                <div class="dropdown-menu">
                    <a href="{{ route('pengaduan.index') }}" class="dropdown-item">Data Pengaduan</a>
                    <a href="{{ route('penilaianlayanan.index') }}" class="dropdown-item">Penilaian Layanan</a>

                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('kategori.index') }}" class="dropdown-item">Kategori</a>
                            <a href="{{ route('tindaklanjut.index') }}" class="dropdown-item">Tindak Lanjut</a>
                        @endif
                    @endauth
                </div>
            </div>

            {{-- User --}}
            @auth
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                   data-bs-toggle="dropdown">
                    <span>{{ Auth::user()->name }}</span>
                    <img src="{{ Auth::user()->profile_picture 
                                ? asset('storage/' . Auth::user()->profile_picture) 
                                : asset('default-avatar.png') }}"
                         class="rounded-circle" width="35" height="35">
                </a>

                <div class="dropdown-menu dropdown-menu-end">
                    <a href="{{ route('auth.logout') }}" class="dropdown-item text-danger">
                        Logout
                    </a>
                </div>
            </div>
            @else
                <a href="{{ route('auth') }}" class="nav-link">Login</a>
            @endauth

        </div>
    </div>
</nav>
<!-- Navbar End -->
