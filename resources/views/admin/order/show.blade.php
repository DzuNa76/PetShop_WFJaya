@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-0 text-gray-800">Detail Order Item</h1>
    <div class="d-sm-flex align-items-center justify-content-end mb-4 my-4">
        <a href="{{ route('order.cetakShow', ['id' => $order->id]) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Cetak</a>
    </div>
    <!-- Detail Order -->
    <div class="card shadow mb-4" id="orderDetail">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Detail Order (Order ID: {{ $order->id }})
            </h6>
        </div>
        <div class="card-body">
            <!-- Nama User -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="namaUser">Nama User:</label>
                        <input type="text" class="form-control" value="{{ $order->user->name }}" disabled />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="tanggalOrder">Tanggal Order:</label>
                        <input type="text" class="form-control" value="{{ $order->created_at }}" disabled />
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Barang</th>
                            <th>Quantity</th>
                            <th>Harga</th>
                            <th>Total Biaya</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->product->price, 2) }}</td>
                            <td>{{ number_format($item->product->price * $item->quantity, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-body">
            {{-- shipping fee --}}
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="totalBiaya">Biaya Pengiriman:</label>
                        <input type="text" class="form-control" value="{{ number_format($order->shipping_fee, 2) }}" disabled />
                    </div>
                </div>
            </div>
            <!-- Total Biaya -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="totalBiaya">Total Biaya:</label>
                        <input type="text" class="form-control" value="{{ number_format($order->total, 2) }}" disabled />
                    </div>
                </div>
            </div>
            <!-- Alamat Pengiriman -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label for="alamatPengiriman">Alamat Pengiriman:</label>
                        <input type="text" class="form-control" value="{{ $order->address }}" disabled />
                    </div>
                </div>
            </div>
        </div>
        <!-- Status Update -->
        <div class="card-body">
            <form action="{{ route('orders.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="statusPembayaran">Status Pembayaran:</label>
                            <select name="payment_status" class="form-control">
                                <option value="Menunggu" {{ $order->payment_status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="Diterima" {{ $order->payment_status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="Gagal" {{ $order->payment_status == 'Gagal' ? 'selected' : '' }}>Gagal</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="statusOrder">Status Pesanan:</label>
                            <select name="order_status" class="form-control">
                                <option value="Proses" {{ $order->order_status == 'Proses' ? 'selected' : '' }}>Proses</option>
                                <option value="Dikirim" {{ $order->order_status == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                                <option value="Diterima" {{ $order->order_status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="Ditolak" {{ $order->order_status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
            
        </div>
    </div>
</div>
<script>
    function printOrder() {
        const printContent = document.getElementById('orderDetail').outerHTML; // Ganti 'orderDetail' dengan id container detail order
        const originalContent = document.body.innerHTML;

        document.body.innerHTML = `
            <html>
            <head>
                <title>Cetak Detail Order</title>
                <style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    table, th, td {
                        border: 1px solid black;
                    }
                    th, td {
                        padding: 10px;
                        text-align: left;
                    }
                </style>
            </head>
            <body>
                <h1>Detail Order</h1>
                ${printContent}
            </body>
            </html>
        `;

        window.print();
        document.body.innerHTML = originalContent; // Kembalikan konten asli
        location.reload(); // Muat ulang halaman
    }
</script>

@endsection
