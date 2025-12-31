<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Models\Multipleupload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns  = ['jenis_kelamin'];
        $searchableColumns  = ['nama', 'no_ktp', 'pekerjaan', 'email'];

        $data['dataWarga'] = Warga::filter($request, $filterableColumns)
                                ->search($request, $searchableColumns)
                                ->paginate(8)
                                ->withQueryString();

        return view('admin.warga.index', $data);
    }

    public function create()
    {
        return view('admin.warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_ktp'        => 'required',
            'nama'          => 'required|string|max:255',
            'jenis_kelamin' => 'required',
            'agama'         => 'required',
            'pekerjaan'     => 'required',
            'phone'         => 'required',
            'email'         => 'required|email|unique:warga,email',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'no_ktp'        => $request->no_ktp,
            'nama'          => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama'         => $request->agama,
            'pekerjaan'     => $request->pekerjaan,
            'phone'         => $request->phone,
            'email'         => $request->email,
        ];

        // KODE BARU: Handle profile picture upload 
        if ($request->hasFile('profile_picture')) { 
            $path = $request->file('profile_picture')->store('profile_pictures', 'public'); 
            $data['profile_picture'] = $path; 
        } 

        Warga::create($data); 

        return redirect()->route('warga.index')->with('success', 'Penambahan Data Warga Berhasil!'); 
    } 


    public function show(string $id)
    {
        $data['dataWarga'] = Warga::with('files')->findOrFail($id);
        return view('admin.warga.show', $data);
    }

    public function edit(string $id)
    {
        $data['dataWarga'] = Warga::findOrFail($id);
        return view('admin.warga.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $warga = Warga::findOrFail($id);

        $request->validate([
            'no_ktp'        => 'required|string|max:100',
            'nama'          => 'required|string|max:255|unique:warga,nama,' . $id . ',warga_id',
            'jenis_kelamin' => 'required|in:Male,Female',
            'agama'         => 'required|string|max:50',
            'pekerjaan'     => 'required|string|max:255',
            'phone'         => 'required|string|max:15',
            'email'         => 'required|email|max:255|unique:warga,email,' . $id . ',warga_id',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'remove_profile_picture' => 'nullable|boolean',
        ]);



        $data = [
            'no_ktp'        => $request->no_ktp,
            'nama'          => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama'         => $request->agama,
            'pekerjaan'     => $request->pekerjaan,
            'phone'         => $request->phone,
            'email'         => $request->email,
        ];

        if ($request->filled('password')) { 
            $data['password'] = Hash::make($request->password); 
        } 

        if ($request->remove_profile_picture) { 
            if ($warga->profile_picture) { 
                Storage::disk('public')->delete($warga->profile_picture); 
            } 
            $data['profile_picture'] = null; 
        } 

        if ($request->hasFile('profile_picture')) { 
            // Delete old picture if exists 
            if ($warga->profile_picture) { 
                Storage::disk('public')->delete($warga->profile_picture); 
            } 
            $path = $request->file('profile_picture')->store('profile_pictures', 'public'); 
            $data['profile_picture'] = $path; 
        } 

        $warga->update($data);

        return redirect()->route('warga.index')
        ->with('update', 'Data Warga berhasil diperbarui.');
    }

    public function uploadFiles(Request $request, string $id)
    {
        $request->validate([
            'files'   => 'required',
            'files.*' => 'mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:2048',
        ]);

        $warga = Warga::findOrFail($id);

        $data = [];

        foreach ($request->file('files') as $file) {
            $path = $file->store('warga_files', 'public');

            $data[] = [
                'filename'   => $path,
                'ref_table'  => 'warga',
                'ref_id'     => $warga->warga_id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Multipleupload::insert($data);

        return back()->with('success', 'File berhasil diupload!');
    }

    public function deleteFile(string $wargaId, string $fileId)
    {
        $file = Multipleupload::where('id', $fileId)
            ->where('ref_table', 'warga')
            ->where('ref_id', $wargaId)
            ->firstOrFail();

        Storage::disk('public')->delete($file->filename);
        $file->delete();

        return back()->with('success', 'File berhasil dihapus!');
    }

    public function destroy(string $id)
    {
        $warga = Warga::with('files')->findOrFail($id);

        if ($warga->profile_picture) {
            Storage::disk('public')->delete($warga->profile_picture);
        }

        foreach ($warga->files as $file) {
            Storage::disk('public')->delete($file->filename);
            $file->delete();
        }

        $warga->delete();

        return redirect()->route('warga.index')
            ->with('success', 'Data Warga berhasil dihapus!');
    }
}
