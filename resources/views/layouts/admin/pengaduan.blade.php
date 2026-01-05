    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between">
                <span>Pengaduan Terbaru</span>
                <a href="{{ route('pengaduan.index') }}" class="btn btn-sm btn-primary">
                    Lihat Semua →
                </a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No. Tiket</th>
                            <th>Warga</th>
                            <th>Judul</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengaduanTerbaru as $item)
                        <tr>
                            <td>{{ $item->no_tiket }}</td>
                            <td>{{ $item->warga->nama ?? '-' }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->status }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>