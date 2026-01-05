@php
    $pageTitle = match (true) {
        request()->routeIs('dashboard') => 'Dashboard',
        request()->routeIs('warga.*') => 'Warga',
        request()->routeIs('tindaklanjut.*') => 'Tindak Lanjut',
        request()->routeIs('pengaduan.*') => 'Pengaduan',
        request()->routeIs('kategori.*') => 'Kategori',
        request()->routeIs('user.*') => 'User',
        request()->routeIs('penilaianlayanan.*') => 'Penilaian Layanan',
        default => 'Dashboard',
    };
@endphp

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm sticky-top px-4">

    {{-- PAGE TITLE --}}
    <h4 class="mb-0 text-primary fw-semibold">
        {{ $pageTitle }}
    </h4>

    {{-- RIGHT MENU --}}
    <div class="ms-auto d-flex align-items-center gap-3">

        {{-- SEARCH --}}
        <form style="width: 260px;">
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-light border-0">
                    <i class="fas fa-search text-primary"></i>
                </span>
                <input type="text"
                       class="form-control border-0 bg-light"
                       placeholder="Cari...">
            </div>
        </form>

        {{-- NOTIFICATION --}}
        <div class="dropdown">
            <a class="nav-link position-relative" href="#" data-bs-toggle="dropdown">
                <i class="fas fa-bell text-primary fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    3
                </span>
            </a>
        </div>
    </div>
</nav>
<!-- Navbar End -->
