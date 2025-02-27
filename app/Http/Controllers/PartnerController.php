<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class PartnerController extends Controller
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
            if ($user->hasRole('partner')) {
                return redirect()->route('partner.dashboard');
            } else {
                Auth::logout(); // Logout jika bukan partner
                return redirect()->route('login.partner')->with('error', 'Akun ini bukan partner.');
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }
    public function index() {

        // Pastikan hanya partner yang bisa mengakses
        if (!Auth::user()->hasRole('partner')) {
            abort(403, 'Unauthorized'); // Blokir akses jika bukan partner
        }

        return view('partner.dashboard'); // Load view dashboard partner
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        $partner = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'admin',
            'password' => Hash::make($request->password),
        ]);

        // Assign role partner
        $partner->assignRole('admin');

        return redirect('/partner/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // LOGOUT
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.partner')->with('success', 'Anda telah logout.');
    }
}
