<!DOCTYPE html>
<html>
<head>
    <title>Data Produk</title>
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
    <table>
        <thead>
            <tr>
                <th>ID Pengiriman</th>
                <th>ID Order</th>
                <th>ID User</th>
                <th>Alamat Penerima</th>
                <th>Metode Pengiriman</th>
                <th>Biaya Pengiriman</th>
                <th>Nomer Resi</th>
                <th>Tanggal Dikirim</th>
                <th>Tanggal Diterima</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($shippings as $shipping)
            <tr>
                <td>{{ $shipping->id }}</td>
                <td>{{ $shipping->order_id }}</td>
                <td>{{ $shipping->user_id }}</td>
                <td>{{ $shipping->address }}</td>
                <td>{{ $shipping->method }}</td>
                <td>{{ number_format($shipping->shipping_fee, 2, ',', '.') }}</td>
                <td>{{ $shipping->tracking_number }}</td>
                <td>{{ $shipping->sent_at }}</td>
                <td>{{ $shipping->received_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
