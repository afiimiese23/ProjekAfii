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

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Lainnya</a>
                <div class="dropdown-menu fade-down m-0">
                    <a href="#" class="dropdown-item">Documentation</a>
                    <a href="#" class="dropdown-item">Upgrade to Pro</a>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- Navbar End -->
