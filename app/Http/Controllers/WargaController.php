<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Multipleupload;
use Illuminate\Support\Facades\Storage;

class WargaController extends Controller
{
    // INDEX
    public function index(Request $request)
    {
        $filterableColumns = ['jenis_kelamin'];
        $searchableColumns = ['nama', 'no_ktp', 'pekerjaan', 'email'];

        $data['dataWarga'] = Warga::filter($request, $filterableColumns)
                                ->search($request, $searchableColumns)
                                ->paginate(8)
                                ->withQueryString();

        return view('admin.warga.index', $data);
    }

    // CREATE
    public function create()
    {
        return view('admin.warga.create');
    }

    // STORE WARGA
    public function store(Request $request)
    {
        $data = $request->only([
            'no_ktp',
            'nama',
            'jenis_kelamin',
            'agama',
            'pekerjaan',
            'phone',
            'email'
        ]);

        $warga = Warga::create($data);

        return redirect()->route('warga.index')
            ->with('success', 'Data Warga berhasil ditambahkan!');
    }

    // SHOW DETAIL WARGA + FILE
    public function show(string $id)
    {
        $data['dataWarga'] = Warga::with('files')->findOrFail($id);
        return view('admin.warga.show', $data);
    }

    // EDIT
    public function edit(string $id)
    {
        $data['dataWarga'] = Warga::findOrFail($id);
        return view('admin.warga.edit', $data);
    }

    // UPDATE
    public function update(Request $request, string $id)
    {
        $warga = Warga::findOrFail($id);

        $warga->update($request->only([
            'no_ktp',
            'nama',
            'jenis_kelamin',
            'agama',
            'pekerjaan',
            'phone',
            'email'
        ]));

        return redirect()->route('warga.index')
            ->with('update', 'Data Warga berhasil diperbarui.');
    }

    // UPLOAD MULTIPLE FILE
    public function uploadFiles(Request $request, string $id)
    {
        $request->validate([
            'files' => 'required',
            'files.*' => 'mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:2048',
        ]);

        $warga = Warga::findOrFail($id);

        if ($request->hasfile('files')) {
            $uploadedFiles = [];

            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    // Nama file unik
                    $filename = round(microtime(true) * 1000) . '-' .
                                str_replace(' ', '-', $file->getClientOriginalName());

                    $path = $file->storeAs('warga_files', $filename, 'public');

                    $uploadedFiles[] = [
                        'filename'   => $path,
                        'ref_table'  => 'warga',
                        'ref_id'     => $warga->warga_id,   // ← SESUAI MODEL
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            Multipleupload::insert($uploadedFiles);

            return redirect()->route('warga.show', $id)
                ->with('success', 'File berhasil diupload!');
        }

        return redirect()->route('warga.show', $id)
            ->with('error', 'Gagal upload file!');
    }

    // DELETE FILE
    public function deleteFile(string $wargaId, string $fileId)
    {
        $file = Multipleupload::where('id', $fileId)
            ->where('ref_table', 'warga')
            ->where('ref_id', $wargaId)
            ->firstOrFail();

        Storage::disk('public')->delete($file->filename);

        $file->delete();

        return redirect()->route('warga.show', $wargaId)
            ->with('success', 'File berhasil dihapus!');
    }

    // DELETE WARGA + FILE
    public function destroy(string $id)
    {
        $warga = Warga::findOrFail($id);

        foreach ($warga->files as $file) {
            Storage::disk('public')->delete($file->filename);
            $file->delete();
        }

        $warga->delete();

        return redirect()->route('warga.index')
            ->with('success', 'Data Warga berhasil dihapus!');
    }
}
