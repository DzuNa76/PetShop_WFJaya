@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Kategori</h1>
    <p>Data kategori berdasarkan kategori jenis barang</p>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('kategori.create') }}" class="btn btn-success">Tambah Kategori</a>
        <a href="{{ route('kategori.cetak') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-download fa-sm text-white-50"></i> Cetak
        </a>        
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>
                    <a href="{{ route('kategori.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('kategori.destroy', $category->id) }}" method="POST" style="display:inline-block;">
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
@endsection
