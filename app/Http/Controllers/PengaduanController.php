<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\Warga;
use App\Models\KategoriPengaduan;
use App\Models\Multipleupload;
use Illuminate\Support\Facades\Storage;

class PengaduanController extends Controller
{
    // INDEX
    public function index(Request $request)
    {
        $filterableColumns = ['status'];
        $searchableColumns = ['nomor_tiket', 'judul', 'lokasi_text'];

        $data['pengaduan'] = Pengaduan::with(['warga', 'kategori'])
            ->when($request->search, function($q) use ($request, $searchableColumns){
                $search = $request->search;
                $q->where(function($query) use ($search, $searchableColumns) {
                    foreach($searchableColumns as $col) {
                        $query->orWhere($col, 'LIKE', "%{$search}%");
                    }
                });
            })
            ->paginate(8)
            ->withQueryString();

        return view('admin.pengaduan.index', $data);
    }

    // CREATE
    public function create()
    {
        $data['warga'] = Warga::all();
        $data['kategori'] = KategoriPengaduan::all();
        return view('admin.pengaduan.create', $data);
    }

    // STORE PENGADUAN
    public function store(Request $request)
    {
        $request->validate([
            'nomor_tiket' => 'required|unique:pengaduan,nomor_tiket',
            'warga_id' => 'required|exists:warga,warga_id',
            'kategori_id' => 'required|exists:kategori_pengaduan,kategori_id',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status' => 'required',
            'lokasi_text' => 'required|string',
            'rt' => 'required|string',
            'rw' => 'required|string',
        ]);

        $data = $request->only([
            'nomor_tiket',
            'warga_id',
            'kategori_id',
            'judul',
            'deskripsi',
            'status',
            'lokasi_text',
            'rt',
            'rw',
        ]);

        $pengaduan = Pengaduan::create($data);

        // Upload media jika ada
        if ($request->hasFile('media')) {
            $uploadedFiles = [];
            foreach ($request->file('media') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                    $path = $file->storeAs('pengaduan_files', $filename, 'public');

                    $uploadedFiles[] = [
                        'filename'   => $path,
                        'ref_table'  => 'pengaduan',
                        'ref_id'     => $pengaduan->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
            Multipleupload::insert($uploadedFiles);
        }

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil ditambahkan!');
    }

    // SHOW DETAIL PENGADUAN + FILE
    public function show(string $id)
    {
        $data['dataPengaduan'] = Pengaduan::with(['files', 'warga', 'kategori'])->findOrFail($id);
        return view('admin.pengaduan.show', $data);
    }

    // EDIT
    public function edit(string $id)
    {
        $data['dataPengaduan'] = Pengaduan::findOrFail($id);
        $data['warga'] = Warga::all();
        $data['kategori'] = KategoriPengaduan::all();
        return view('admin.pengaduan.edit', $data);
    }

    // UPDATE
    public function update(Request $request, string $id)
    {
        $pengaduan = Pengaduan::findOrFail($id);

        $pengaduan->update($request->only([
            'nomor_tiket',
            'warga_id',
            'kategori_id',
            'judul',
            'deskripsi',
            'status',
            'lokasi_text',
            'rt',
            'rw',
        ]));

        // Upload media jika ada
        if ($request->hasFile('media')) {
            $uploadedFiles = [];
            foreach ($request->file('media') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000) . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                    $path = $file->storeAs('pengaduan_files', $filename, 'public');

                    $uploadedFiles[] = [
                        'filename'   => $path,
                        'ref_table'  => 'pengaduan',
                        'ref_id'     => $pengaduan->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
            Multipleupload::insert($uploadedFiles);
        }

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil diperbarui!');
    }

    // UPLOAD MULTIPLE FILE
    public function uploadFiles(Request $request, string $id)
    {
        $request->validate([
            'files' => 'required',
            'files.*' => 'mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:2048',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);

        if ($request->hasfile('files')) {
            $uploadedFiles = [];

            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    // Nama file unik
                    $filename = round(microtime(true) * 1000) . '-' .
                                str_replace(' ', '-', $file->getClientOriginalName());

                    $path = $file->storeAs('pengaduan', $filename, 'public');

                    $uploadedFiles[] = [
                        'filename'   => $path,
                        'ref_table'  => 'pengaduan',
                        'ref_id'     => $pengaduan->id,   // ← SESUAI MODEL
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            Multipleupload::insert($uploadedFiles);

            return redirect()->route('pengaduan.show', $id)
                ->with('success', 'File berhasil diupload!');
        }

        return redirect()->route('pengaduan.show', $id)
            ->with('error', 'Gagal upload file!');
    }

    // DELETE FILE
    public function deleteFile(string $pengaduanId, string $fileId)
    {
        $file = Multipleupload::where('id', $fileId)
            ->where('ref_table', 'pengaduan')
            ->where('ref_id', $pengaduanId)
            ->firstOrFail();

        Storage::disk('public')->delete($file->filename);

        $file->delete();

        return redirect()->route('pengaduan.show', $pengaduanId)
            ->with('success', 'File berhasil dihapus!');
    }

    // DELETE PENGADUAN + FILE
    public function destroy(string $id)
    {
        $pengaduan = Pengaduan::with('files')->findOrFail($id);

        foreach ($pengaduan->files as $file) {
            Storage::disk('public')->delete($file->filename);
            $file->delete();
        }

        $pengaduan->delete();

        return redirect()->route('pengaduan.index')
            ->with('success', 'Pengaduan berhasil dihapus!');
    }
}
