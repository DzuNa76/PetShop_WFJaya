<?php

namespace App\Http\Controllers;
class AboutController extends Controller
{
    // Menampilkan daftar kategori
    public function index()
    {
        return view('user.about');
    }
}