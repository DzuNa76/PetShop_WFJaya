<?php

namespace App\Http\Controllers;

use App\Models\Pengguna; // Assuming you have a Customer model
use Barryvdh\DomPDF\Facade\Pdf; // To generate the PDF
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Method to display the customer list
    public function index()
    {
        $customers = Pengguna::all(); // Fetch all customers from the database
        return view('admin.customer.index', compact('customers')); // Pass the data to the view
    }

    // Method to generate the PDF report
    public function cetak()
    {
        $customers = Pengguna::all(); // Fetch all customers
        $pdf = Pdf::loadView('admin.customer.cetak', compact('customers')); // Generate the PDF view
        return $pdf->download('customer_report.pdf'); // Return the PDF for download
    }
}
