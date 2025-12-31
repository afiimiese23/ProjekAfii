<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
         if (Auth::check()) {
		      return redirect()->route('dashboard');
		    }
        return view('auth.login');
    }
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,pelanggan,mitra',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // upload foto
        $profilePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePath = $request->file('profile_picture')
                ->store('profile_pictures', 'public');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'profile_picture' => $profilePath,
        ]);

        return redirect()->route('login')
            ->with('success', 'Registrasi berhasil, silakan login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            // Simpan pesan ke session
            session(['last_login' => now()]);
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        } else {
            return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
        }
    }
    function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();     // Hapus semua session
        $request->session()->regenerateToken(); // Cegah CSRF
        return redirect()->route('auth');
        // Redirect ke halaman login
    }
}
