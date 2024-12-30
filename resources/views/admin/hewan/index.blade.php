@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Jenis Hewan</h1>
    <p>Data jenis hewan</p>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('hewan.create') }}" class="btn btn-success">Tambah Hewan</a>
        <a href="{{ route('hewan.cetak') }}" class="btn btn-primary shadow-sm">
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
                <th>Nama Hewan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($hewans as $hewan)
            <tr>
                <td>{{ $hewan->id }}</td>
                <td>{{ $hewan->name }}</td>
                <td>
                    <a href="{{ route('hewan.edit', $hewan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('hewan.destroy', $hewan->id) }}" method="POST" style="display:inline-block;">
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
