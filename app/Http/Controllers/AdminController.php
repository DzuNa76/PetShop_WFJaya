<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:8',  // Remove the 'confirmed' rule
        ]);
    
        Admin::create([
            'name' => $request->name,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Hash password
        ]);
    
        return redirect()->route('admin.index')->with('success', 'Admin berhasil ditambahkan.');
    }
    
    public function edit($id)
    {
        // Get the logged-in admin
        $admin = Auth::guard('admin')->user();
    
        // Ensure the logged-in admin can only edit their own account
        if ($admin->id != $id) {
            return redirect()->route('admin.index')->with('error', 'Unauthorized action.');
        }
    
        // Get the admin to edit
        $adminToEdit = Admin::findOrFail($id);
        return view('admin.admins.edit', compact('adminToEdit'));
    }
    
    public function update(Request $request, $id)
    {
        // Get the logged-in admin
        $admin = Auth::guard('admin')->user();
    
        // Ensure the logged-in admin can only update their own account
        if ($admin->id != $id) {
            return redirect()->route('admin.index')->with('error', 'Unauthorized action.');
        }
    
        $request->validate([
            'name' => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:admins,email,' . $id,
            'password' => 'nullable|string|min:8',
        ]);
    
        $adminToUpdate = Admin::findOrFail($id);
    
        // Update only the fields that were changed
        $adminToUpdate->update([
            'name' => $request->name,
            'alamat' => $request->alamat,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $adminToUpdate->password,
        ]);
    
        return redirect()->route('admin.index')->with('success', 'Admin berhasil diperbarui.');
    }
    
    
    public function destroy($id)
    {
        // Get the currently logged-in admin
        $admin = Auth::guard('admin')->user();
    
        // Ensure the logged-in admin can only delete their own account
        if ($admin->id != $id) {
            return redirect()->route('admin.index')->with('error', 'Unauthorized action. You cannot delete other admin accounts.');
        }
    
        // Proceed with deletion of the admin account
        Admin::findOrFail($id)->delete();
    
        // Logout the admin
        Auth::guard('admin')->logout();
    
        // Clear the session to prevent issues after logging out
        Session::flush();
    
        // Redirect the user to the login page after successful deletion and logout
        return redirect()->route('admin.login')->with('success', 'Your account has been deleted successfully. You are now logged out.');
    }    


    public function cetak()
    {
        $admins = Admin::all();
        $pdf = Pdf::loadview('admin.admins.cetak', compact('admins'));
        return $pdf->download('laporan-admins.pdf');
    }
}
