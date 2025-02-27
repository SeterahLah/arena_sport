<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        // Coba autentikasi user dengan role partner
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Pastikan user yang login adalah partner
            if ($user->hasRole('user')) {
                return redirect()->route('beranda');
            } else {
                Auth::logout(); // Logout jika bukan partner
                return redirect()->route('login.user')->with('error', 'Akun ini bukan partner.');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function index() {

        // Pastikan hanya partner yang bisa mengakses
        if (!Auth::user()->hasRole('user')) {
            abort(403, 'Unauthorized'); // Blokir akses jika bukan partner
        }

        return view('beranda'); // Load view dashboard partner
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'user',
            'password' => Hash::make($request->password),
        ]);

        // Assign role user
        $user->assignRole('user');

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.user')->with('success', 'Anda telah logout.');
    }
}
