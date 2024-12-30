<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil pengguna.
     */
    public function index() { 
        // Periksa apakah pengguna sudah login 
        if (!Auth::check()) { 
            return redirect()->route('user.login')->with('error', 'Harap login untuk mengakses profil Anda.'); 
        } 
        // Ambil data pengguna yang sedang login 
        $pengguna = Auth::user(); 
        // Kirim data pengguna ke view 
        return view('user.profile', ['pengguna' => $pengguna]);
    }

    /**
     * Logout pengguna.
     */
    public function logout()
    {
        Auth::logout();

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('user.login')->with('success', 'Anda berhasil logout.');
    }


    public function edit()
    {
        $user = Auth::user();
        return view('user.edit-profile', compact('user'));
    }


    public function updateProfile(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:pengguna,email,' . Auth::id(),
            'phone_number' => 'required|string|max:15',
        ]);

        // Ambil pengguna yang sedang login
        $user = Pengguna::find(Auth::id());

        // Jika pengguna tidak ditemukan
        if (!$user) {
            return redirect()->back()->with('error', 'Pengguna tidak ditemukan.');
        }

        // Perbarui data pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        // Simpan perubahan
        $user->save();
        
        // Redirect kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Profil berhasil diperbarui.');
        // return redirect()->route('user.profile')->with('success', 'Profil berhasil diperbarui.');
    }
}
