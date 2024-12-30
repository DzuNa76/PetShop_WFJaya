@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Order Masuk</h1>
        <a href="{{ route('order.cetak') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Cetak
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID Order</th>
                            <th>Tanggal Order</th>
                            <th>ID User</th>
                            <th>Total</th>
                            <th>Status Pembayaran</th>
                            <th>Status Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td> <!-- Menampilkan nomor urut -->
                            <td>{{ $order->created_at }}</td>
                            <td>{{ $order->user->name ?? 'User tidak ditemukan' }}</td> <!-- Nama User dari relasi -->
                            <td>Rp {{ number_format($order->total, 2, ',', '.') }}</td> <!-- Format mata uang -->
                            <td>
                                <span class="badge 
                                    {{ $order->payment_status == 'Diterima' ? 'badge-success' : ($order->payment_status == 'failed' ? 'badge-danger' : 'badge-warning') }}">
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge 
                                    {{ $order->order_status == 'Dikirim' ? 'badge-primary' : ($order->order_status == 'ditolak' ? 'badge-danger' : 'badge-secondary') }}">
                                    {{ ucfirst($order->order_status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-warning btn-sm">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data pesanan.</td>
                        </tr>
                        @endforelse
                    </tbody>                    
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
