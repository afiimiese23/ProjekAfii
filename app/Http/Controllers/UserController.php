<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchableColumns = ['name', 'email', 'password'];

        // Proses filter + pagination
        $data['dataUser'] = User::search($request, $searchableColumns)
                                ->simplePaginate(8)
                                ->withQueryString();

        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:8|confirmed',
             'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // VALIDASI BARU 
        ]);

        $data = [ 
            'name' => $request->name, 
            'email' => $request->email, 
            'password' => Hash::make($request->password), 
        ]; 
    
        // KODE BARU: Handle profile picture upload 
        if ($request->hasFile('profile_picture')) { 
            $path = $request->file('profile_picture')->store('profile_pictures', 'public'); 
            $data['profile_picture'] = $path; 
        } 

        User::create($data);

        return redirect()->route('user.index')
        ->with('success', 'Data User berhasil ditambahkan!');
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
        $data['dataUser'] = User::findOrFail($id);
        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);


        $request->validate([ 
            'name' => 'required|max:100', 
            'email' => ['required', 'email', 'unique:users,email,' . $id], 
            'password' => 'nullable|min:8|confirmed', 
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',        
            'remove_profile_picture' => 'nullable|boolean', // BARU 
        ]); 
         
        $data = [ 
            'name' => $request->name, 
            'email' => $request->email, 
        ]; 

        if ($request->filled('password')) { 
            $data['password'] = Hash::make($request->password); 
        }

        if ($request->remove_profile_picture) { 
            if ($user->profile_picture) { 
                Storage::disk('public')->delete($user->profile_picture); 
            } 
            $data['profile_picture'] = null; 
        } 

        
        if ($request->hasFile('profile_picture')) { 
            // Delete old picture if exists 
            if ($user->profile_picture) { 
                Storage::disk('public')->delete($user->profile_picture); 
            } 
            $path = $request->file('profile_picture')->store('profile_pictures', 'public'); 
            $data['profile_picture'] = $path; 
        } 

        $user->update($data);

        return redirect()->route('user.index')
        ->with('update', 'Data User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
         
        if ($user->profile_picture) { 
            Storage::disk('public')->delete($user->profile_picture); 
        } 
        
        $user->delete();

        return redirect()->route('user.index')
            ->with('success', 'User berhasil dihapus!'); 
    }
}
