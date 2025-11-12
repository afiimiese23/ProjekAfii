<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['dataWarga'] = Warga::all();
		return view('admin.warga.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warga.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data['no_ktp'] = $request->no_ktp;
		$data['nama'] = $request->nama;
		$data['gender'] = $request->gender;
		$data['agama'] = $request->agama;
		$data['pekerjaan'] = $request->pekerjaan;
		$data['phone'] = $request->phone;
        $data['email'] = $request->email;

		Warga::create($data);

		return redirect()->route('warga.index')->with('success','Penambahan Data Berhasil!');
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
        $data['dataWarga'] = Warga::findOrFail($id);
        return view('admin.warga.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $warga_id = $id;
        $warga = Warga::findOrFail($warga_id);

        $warga->no_ktp = $request->no_ktp;
        $warga->nama = $request->nama;
        $warga->gender = $request->gender;
        $warga->agama = $request->agama;
        $warga->pekerjaan = $request->pekerjaan;
        $warga->phone = $request->phone;
        $warga->email = $request->email;

        $warga->save();

        return redirect()->route('warga.index')
            ->with('update', 'Perubahan Data Berhasil!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warga = Warga::findOrFail($id);

        $warga -> delete();
        return redirect() -> route ('warga.index') -> with('success', 'Data berhasil dihapus');
    }
}
