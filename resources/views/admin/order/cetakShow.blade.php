<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Detail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .header {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Detail Order (Order ID: {{ $order->id }})</h2>
        <p><strong>Nama User:</strong> {{ $order->user->name }}</p>
        <p><strong>Tanggal Order:</strong> {{ $order->created_at }}</p>
    </div>

    <h3>Items</h3>
    <table>
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

    <h3>Detail Lainnya</h3>
    <p><strong>Total Biaya:</strong> Rp {{ number_format($order->total, 2) }}</p>
    <p><strong>Alamat Pengiriman:</strong> {{ $order->address }}</p>
    <p><strong>Status Pembayaran:</strong> {{ $order->payment_status }}</p>
    <p><strong>Status Pesanan:</strong> {{ $order->order_status }}</p>
</body>
</html>
