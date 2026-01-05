    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between">
                <span>Tindak Lanjut Terbaru</span>
                <a href="{{ route('tindaklanjut.index') }}" class="btn btn-sm btn-primary">
                    Lihat Semua →
                </a>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No. Tiket</th>
                            <th>Petugas</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tindakLanjutTerbaru as $item)
                        <tr>
                            <td>{{ $item->pengaduan->no_tiket ?? '-' }}</td>
                            <td>{{ $item->petugas }}</td>
                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada data</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>