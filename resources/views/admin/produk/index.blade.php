@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Produk</h1>
    <p class="mb-4">Data produk</p>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('produk.create') }}" class="btn btn-success">Tambah Produk</a>
        <a href="{{ route('produk.cetak') }}" class="btn btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Cetak</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->jenis_category_id }}</td>
                            <td>{{ $product->animal_category_id }}</td>
                            <td>{{ $product->id }}</td>
                            <td>
                                @if ($product->image_url)
                                    <img src="{{ asset('storage/' . $product->image_url) }}" class="gmbrprd" alt="Gambar Produk">
                                @else
                                    <span>Gambar tidak tersedia</span>
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>{{ $product->berat }} G</td>
                            <td>
                                <a href="{{ route('produk.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('produk.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>
<style>
    .gmbrprd {
    width: 130px;
    height: 130px;
    object-fit: contain;
    display: block;
    margin: 0 auto;
}
</style>
@endsection
