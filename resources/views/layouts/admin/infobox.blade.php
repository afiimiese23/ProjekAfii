<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="card dashboard-card shadow-sm">
            <div class="card-body">
                <h3>{{ $totalWarga }}</h3>
                <p>Total Warga</p>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('warga.index') }}">More info →</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card dashboard-card shadow-sm">
            <div class="card-body">
                <h3>{{ $totalKategori }}</h3>
                <p>Kategori Pengaduan</p>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('kategori.index') }}">More info →</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card dashboard-card shadow-sm">
            <div class="card-body">
                <h3>{{ $totalPengaduan }}</h3>
                <p>Total Pengaduan</p>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('pengaduan.index') }}">More info →</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card dashboard-card shadow-sm">
            <div class="card-body">
                <h3>{{ $pengaduanBaru }}</h3>
                <p>Pengaduan Baru</p>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('pengaduan.index') }}">More info →</a>
            </div>
        </div>
    </div>

</div>

<div class="row g-3 mb-4">

    <div class="col-md-3">
        <div class="card dashboard-card shadow-sm">
            <div class="card-body">
                <h3>{{ $totalTindakLanjut }}</h3>
                <p>Total Tindak Lanjut</p>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('tindaklanjut.index') }}">More info →</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card dashboard-card shadow-sm">
            <div class="card-body">
                <h3>{{ $totalPenilaian }}</h3>
                <p>Total Penilaian</p>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('penilaianlayanan.index') }}">More info →</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card dashboard-card shadow-sm">
            <div class="card-body">
                <h3>{{ number_format($rataRating,1) }}</h3>
                <p>Rata-rata Rating</p>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('penilaianlayanan.index') }}">More info →</a>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card dashboard-card shadow-sm">
            <div class="card-body">
                <h3>{{ $pengaduanSelesai }}</h3>
                <p>Pengaduan Selesai</p>
            </div>
            <div class="card-footer text-center">
                <a href="{{ route('pengaduan.index') }}">More info →</a>
            </div>
        </div>
    </div>

</div>