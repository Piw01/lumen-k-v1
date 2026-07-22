<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Tambahkan ini
use Illuminate\Support\Facades\Hash; // Tambahkan ini

class AuthController extends Controller
{
    // Menampilkan halaman form login
    public function index()
    {
        return view('auth.login');
    }

    // Memproses data yang dikirim dari form login
    public function authenticate(Request $request)
    {
        // 1. Validasi inputan form
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Cek apakah email dan password cocok di database
        if (Auth::attempt($credentials)) {
            // Jika berhasil, buat sesi (session) baru
            $request->session()->regenerate();

            // Arahkan berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('/admin/dashboard'); // Nanti kita buat halaman ini
            }
            
            return redirect()->intended('/'); // Customer kembali ke halaman utama
        }

        // 3. Jika gagal login, kembalikan ke halaman login bawa pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Memproses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function register()
    {
        return view('auth.register');
    }

    /**
     * Proses pendaftaran akun baru
     */
    public function storeRegister(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed', // Harus ada input 'password_confirmation' di form
        ], [
            'email.unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain atau login.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal harus 8 karakter.'
        ]);

        // 2. Simpan user ke database dengan role otomatis 'customer'
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'customer', // Paksa role menjadi customer untuk keamanan
        ]);

        // 3. Arahkan kembali ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login untuk mulai menyewa alat.');
    }
}