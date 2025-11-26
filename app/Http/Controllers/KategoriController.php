<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriPengaduan;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchableColumns = ['nama', 'sla_hari', 'prioritas'];

        // Proses filter + pagination
        $data['dataKategori'] = KategoriPengaduan::search($request, $searchableColumns)
                                ->paginate(8)
                                ->withQueryString();

        return view('admin.Pengaduan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pengaduan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data['nama'] = $request->nama;
        $data['sla_hari'] = $request->sla_hari;
        $data['prioritas'] = $request->prioritas;

        KategoriPengaduan::create($data);

         return redirect()->route('kategori.index')
         ->with('success', 'Kategori pengaduan berhasil ditambahkan!');

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
    public function edit($kategori_id)
{
    $data['dataKategori'] = KategoriPengaduan::findOrFail($kategori_id);
    return view('admin.pengaduan.edit', $data);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kategori_id)
{
    $kategori = KategoriPengaduan::findOrFail($kategori_id);

    $kategori->update([
        'nama' => $request->nama,
        'sla_hari' => $request->sla_hari,
        'prioritas' => $request->prioritas,
    ]);

    return redirect()->route('kategori.index')
    ->with('success', 'Data kategori berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        //dd("Function destroy kepanggil dengan ID: " . $id);
        
        $kategori = KategoriPengaduan::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori pengaduan berhasil dihapus!'); 
    }
}
