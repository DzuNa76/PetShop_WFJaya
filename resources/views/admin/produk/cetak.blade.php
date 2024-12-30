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
                <th>ID Kategori</th>
                <th>ID Hewan</th>
                <th>ID Produk</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Stok Produk</th>
                <th>Berat Produk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $products)
            <tr>
                <td>{{ $products->jenis_category_id }}</td>
                <td>{{ $products->animal_category_id }}</td>
                <td>{{ $products->id }}</td>
                <td>
                    @if ($products->image_url)
                        <img src="{{ public_path('storage/' . $products->image_url) }}" class="gmbrprd" alt="Gambar Produk">
                    @else
                        <span>Gambar tidak tersedia</span>
                    @endif
                </td>
                <td>{{ $products->name }}</td>
                <td>{{ $products->description }}</td>
                <td>Rp {{ number_format($products->price, 2, ',', '.') }}</td>
                <td>{{ $products->stock }}</td>
                <td>{{ $products->berat }} G</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
