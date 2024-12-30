<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login'); // sesuaikan dengan lokasi view
    }

    public function login(Request $request)
    {
        // Validasi input login
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cek apakah username dan password sesuai
        $credentials = [
            'name' => $request->username,
            'password' => $request->password,
        ];

        if (Auth::guard('admin')->attempt($credentials)) {
            // Redirect ke halaman admin jika login berhasil
            return redirect()->route('admin.indexadmin');
        } else {
            // Jika login gagal, kembali ke halaman login dengan pesan error
            return back()->with('loginError', 'Username atau password salah!');
        }        
    }

    public function logout(Request $request)
    {
        // Logout dari guard admin
        Auth::guard('admin')->logout();
    
        // Invalidasi sesi
        $request->session()->invalidate();
    
        // Regenerasi token CSRF
        $request->session()->regenerateToken();
    
        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }    

}
