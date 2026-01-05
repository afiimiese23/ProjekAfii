<!-- Sidebar Start -->
<div class="sidebar bg-white shadow">

    {{-- USER --}}
        @if(Auth::check())
            <div class="sidebar-header text-center py-4 border-bottom">
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <img src="{{ Auth::user()->profile_picture
                            ? asset('storage/' . Auth::user()->profile_picture)
                            : asset('default-avatar.png') }}"
                        class="rounded-circle"
                        width="60" height="60"
                        style="object-fit: cover;">
                    <h5 class="text-black fw-bold mb-0">{{ Auth::user()->name }}</h5>
                </a>
            </div>
        @endif

    {{-- Menu --}}
    <div class="sidebar-menu p-3">

        <a href="{{ route('dashboard') }}"
           class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-home me-2"></i> Dashboard
        </a>

        <a href="{{ route('user.index') }}"
           class="menu-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
            <i class="fas fa-users me-2"></i> User
        </a>

        <a href="{{ route('warga.index') }}"
           class="menu-item {{ request()->routeIs('warga.*') ? 'active' : '' }}">
            <i class="fas fa-user-friends me-2"></i> Warga
        </a>

        <hr>

        <span class="menu-title">Pengaduan</span>

        <a href="{{ route('pengaduan.index') }}"
           class="menu-item {{ request()->routeIs('pengaduan.*') ? 'active' : '' }}">
            <i class="fas fa-file-alt me-2"></i> Data Pengaduan
        </a>

        <a href="{{ route('penilaianlayanan.index') }}"
           class="menu-item {{ request()->routeIs('penilaianlayanan.*') ? 'active' : '' }}">
            <i class="fas fa-star me-2"></i> Penilaian Layanan
        </a>

        <a href="{{ route('kategori.index') }}"
           class="menu-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
            <i class="fas fa-tags me-2"></i> Kategori Pengaduan
        </a>

        <a href="{{ route('tindaklanjut.index') }}"
           class="menu-item {{ request()->routeIs('tindaklanjut.*') ? 'active' : '' }}">
            <i class="fas fa-tasks me-2"></i> Tindak Lanjut
        </a>

        <hr>
        
            <span class="menu-title">
                Last login: {{ session('last_login') }}
            </span>

            <a href="#" class="menu-item">
                <i class="bi bi-gear me-2"></i> Settings
            </a>

            <a href="{{ route('auth.logout') }}" class="menu-item text-danger">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </a>
                
    </div>
</div>
<!-- Sidebar End -->
