<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\KategoriPengaduan;
use App\Models\Pengaduan;
use App\Models\TindakLanjut;
use App\Models\PenilaianLayanan;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // DATA RINGKASAN
        $totalWarga = Warga::count();
        $totalKategori = KategoriPengaduan::count();
        $totalPengaduan = Pengaduan::count();
        $pengaduanBaru = Pengaduan::where('status', 'Baru')->count();
        $pengaduanSelesai = Pengaduan::where('status', 'Selesai')->count();
        $totalTindakLanjut = TindakLanjut::count();
        $totalPenilaian = PenilaianLayanan::count();
        $rataRating = PenilaianLayanan::avg('rating') ?? 0;

        // DATA TERBARU
        $pengaduanTerbaru = Pengaduan::with('warga')
            ->latest()
            ->take(5)
            ->get();

        $tindakLanjutTerbaru = TindakLanjut::latest()
            ->take(5)
            ->get();

        // TESTIMONIAL (tetap dipakai)
        $testimonials = PenilaianLayanan::with('pengaduan.warga')
            ->latest()
            ->take(8)
            ->get();

        return view('admin.dashboard', compact(
            'totalWarga',
            'totalKategori',
            'totalPengaduan',
            'pengaduanBaru',
            'pengaduanSelesai',
            'totalTindakLanjut',
            'totalPenilaian',
            'rataRating',
            'pengaduanTerbaru',
            'tindakLanjutTerbaru',
            'testimonials'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
