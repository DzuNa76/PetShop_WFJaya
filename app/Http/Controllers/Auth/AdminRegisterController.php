<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminRegisterController extends Controller
{
    public function showRegisterForm()
    {
        return view('admin.auth.register'); // Menampilkan view register
    }

    public function register(Request $request)
    {
        // Validasi input registrasi
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string',
        ]);

        // Simpan data admin ke database
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
            // 'role' => 'admin' // Misal default role sebagai admin
        ]);

        // Redirect ke halaman login setelah berhasil register
        return redirect()->route('admin.indexadmin')->with('success', 'Account created successfully. Please login.');
    }
}
