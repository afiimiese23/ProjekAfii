<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TindakLanjut;
use App\Models\Pengaduan;
use App\Models\Multipleupload;
use Illuminate\Support\Facades\Storage;

class TindakLanjutController extends Controller
{
    // INDEX
    public function index(Request $request)
    {
        $searchableColumns = ['petugas', 'aksi', 'catatan'];

        $data['dataTindakLanjut'] = TindakLanjut::with('pengaduan')
            ->when($request->search, function($q) use ($request, $searchableColumns){
                $search = $request->search;
                $q->where(function($query) use ($search, $searchableColumns){
                    foreach($searchableColumns as $col){
                        $query->orWhere($col, 'LIKE', "%{$search}%");
                    }
                });
            })
            ->paginate(8)
            ->withQueryString();

        return view('admin.tindaklanjut.index', $data);
    }

    // CREATE
    public function create()
    {
        $data['pengaduan'] = Pengaduan::all();
        return view('admin.tindaklanjut.create', $data);
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'pengaduan_id' => 'required|exists:pengaduan,id',
            'petugas' => 'required|string|max:255',
            'aksi' => 'required|string|max:255',
            'catatan' => 'nullable|string',
        ]);

        $data = $request->only(['pengaduan_id','petugas','aksi','catatan']);
        $tindak = TindakLanjut::create($data);

        return redirect()->route('tindaklanjut.index', $tindak->tindak_id)
            ->with('success', 'Tindak Lanjut berhasil ditambahkan!');
    }

    // SHOW DETAIL
    public function show(string $id)
    {
        $data['dataTindakLanjut'] = TindakLanjut::with(['pengaduan','files'])->findOrFail($id);
        return view('admin.tindaklanjut.show', $data);
    }

    // EDIT
    public function edit(string $id)
    {
        $data['dataTindakLanjut'] = TindakLanjut::findOrFail($id);
        $data['pengaduan'] = Pengaduan::all();
        return view('admin.tindaklanjut.edit', $data);
    }
    
    // UPDATE
    public function update(Request $request, string $id)
    {
        $tindak = TindakLanjut::findOrFail($id);

        $tindak->update($request->only(['pengaduan_id','petugas','aksi','catatan']));

        return redirect()->route('tindaklanjut.index', $id)
            ->with('success', 'Tindak Lanjut berhasil diperbarui!');
    }

    // DELETE
    public function destroy(string $id)
    {
        $tindak = TindakLanjut::with('files')->findOrFail($id);

        foreach ($tindak->files as $file) {
            Storage::disk('public')->delete($file->filename);
            $file->delete();
        }

        $tindak->delete();

        return redirect()->route('tindaklanjut.index')
            ->with('success', 'Tindak Lanjut berhasil dihapus!');
    }

    // UPLOAD FILE
    public function uploadFiles(Request $request, string $id)
    {
        $request->validate([
            'files' => 'required',
            'files.*' => 'mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:2048',
        ]);

        $tindak = TindakLanjut::findOrFail($id);

        if ($request->hasfile('files')) {
            $uploadedFiles = [];

            foreach ($request->file('files') as $file) {
                if ($file->isValid()) {
                    $filename = round(microtime(true) * 1000) . '-' .
                                str_replace(' ', '-', $file->getClientOriginalName());

                    $path = $file->storeAs('tindaklanjut', $filename, 'public');

                    $uploadedFiles[] = [
                        'filename'   => $path,
                        'ref_table'  => 'tindak_lanjut',
                        'ref_id'     => $tindak->tindak_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }

            Multipleupload::insert($uploadedFiles);

            return redirect()->route('tindaklanjut.show', $id)
                ->with('success', 'File berhasil diupload!');
        }

        return redirect()->route('tindaklanjut.show', $id)
            ->with('error', 'Gagal upload file!');
    }

    // DELETE FILE
    public function deleteFile(string $tindakId, string $fileId)
    {
        $file = Multipleupload::where('id', $fileId)
            ->where('ref_table', 'tindak_lanjut')
            ->where('ref_id', $tindakId)
            ->firstOrFail();

        Storage::disk('public')->delete($file->filename);

        $file->delete();

        return redirect()->route('tindaklanjut.show', $tindakId)
            ->with('success', 'File berhasil dihapus!');
    }
}
