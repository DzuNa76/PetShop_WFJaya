<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class PenggunaController extends Controller
{
    /**
     * Halaman login.
     */
    public function showLogin()
    {
        return view('user.auth.loginUser');
    }

    /**
     * Proses login.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/indexuser'); // Redirect ke index
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Halaman registrasi.
     */
    public function showRegister()
    {
        return view('user.auth.registerUser');
    }

    /**
     * Proses registrasi.
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:pengguna,email',
            'password' => 'required|confirmed|min:8',
            'phone_number' => 'nullable|string|max:20',
        ]);

        $data['password'] = Hash::make($data['password']);

        Pengguna::create($data);

        return redirect('/indexuser')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    /**
     * Halaman keranjang (harus login).
     */
    public function keranjang()
    {
        // $this->middleware('auth'); // Middleware memastikan pengguna login
        return view('keranjang');
    }
}
