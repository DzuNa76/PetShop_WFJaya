<!DOCTYPE html>
<html>
<head>
    <title>Data Order</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .gmbrprd {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Data Produk</h1>
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID Order</th>
                <th>ID User</th>
                <th>Total</th>
                <th>Status Pembayaran</th>
                <th>Status Order</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td> <!-- Menampilkan nomor urut -->
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
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data pesanan.</td>
            </tr>
            @endforelse
        </tbody>                    
    </table>
</body>
</html>
