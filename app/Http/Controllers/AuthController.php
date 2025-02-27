<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
    // PROSES LOGIN
    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|min:8',
    //     ]);

    //     // Coba autentikasi 
    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         $user = Auth::user();

    //         // Pastikan user yang login adalah partner
    //         if ($user->hasRole('admin')) {
    //             return redirect()->route('admin.dashboard');
    //         } else {
    //             Auth::logout(); // Logout jika bukan admin
    //             return redirect()->route('login.admin')->with('error', 'Akun ini bukan partner.');
    //         }
    //     }

    //     return back()->withErrors(['email' => 'Email atau password salah.']);
    // }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Redirect berdasarkan role
            if ($user->hasRole('admin')) {
                return redirect('/admin/dashboard');
            } 
        }

        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

    public function index() {

        // Pastikan hanya partner yang bisa mengakses
        if (!Auth::user()->hasRole('admin')) {
            abort(403, 'Unauthorized'); // Blokir akses jika bukan partner
        }

        return view('admin.dashboard'); // Load view dashboard admin
    }

    // PROSES REGISTRASI
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            // 'role' => 'required|in:user,partner,admin', // Hanya user atau partner
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Assign role berdasarkan pilihan
        $user->assignRole($request->role);

        return redirect('/admin/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // LOGOUT
    public function logout()
    {
        Auth::logout();
        return redirect('admin.login');
    }
}