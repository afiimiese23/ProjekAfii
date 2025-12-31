<?php

namespace App\Http\Controllers;

use App\Models\PenilaianLayanan;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PenilaianLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchableColumns = ['rating', 'komentar'];

        $data['dataPenilaianLayanan'] = PenilaianLayanan::with('pengaduan')
            ->search($request, $searchableColumns)
            ->simplePaginate(8)
            ->withQueryString();

        return view('admin.penilaianlayanan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataPengaduan = Pengaduan::orderBy('id', 'desc')->get();

        return view('admin.penilaianlayanan.create', [
            'dataPengaduan' => $dataPengaduan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,id', // FK VALID
            'rating'       => 'required|integer|min:1|max:5',
            'komentar'     => 'nullable|string',
        ]);

        PenilaianLayanan::create([
            'pengaduan_id' => $request->pengaduan_id, // AMBIL DARI pengaduan.id
            'rating'       => $request->rating,
            'komentar'     => $request->komentar,
        ]);

        return redirect()->route('penilaianlayanan.index')
            ->with('success', 'Penilaian layanan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['dataPenilaian'] = PenilaianLayanan::findOrFail($id);

        return view('admin.penilaianlayanan.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dataPenilaianLayanan = PenilaianLayanan::findOrFail($id);
        $dataPengaduan = Pengaduan::orderBy('id', 'desc')->get();

        return view('admin.penilaianlayanan.edit', [
            'dataPenilaianLayanan' => $dataPenilaianLayanan,
            'dataPengaduan' => $dataPengaduan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $penilaian = PenilaianLayanan::findOrFail($id);

        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,id',
            'rating'       => 'required|integer|min:1|max:5',
            'komentar'     => 'nullable|string',
        ]);

        $penilaian->update([
            'pengaduan_id' => $request->pengaduan_id,
            'rating'       => $request->rating,
            'komentar'     => $request->komentar,
        ]);

        return redirect()->route('penilaianlayanan.index')
            ->with('update', 'Penilaian layanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penilaian = PenilaianLayanan::findOrFail($id);
        $penilaian->delete();

        return redirect()->route('penilaianlayanan.index')
            ->with('success', 'Penilaian layanan berhasil dihapus!');
    }
}
