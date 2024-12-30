@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Kategori</h1>

    <!-- Form -->
    <div class="card shadow mb-4" style="max-width: 400px; margin: 0 auto;">
        <div class="card-body">
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="idKategori">ID Kategori</label>
                    <input type="text" class="form-control" id="idKategori" name="idKategori" value="{{ $lastId }}" disabled>
                </div>
                <div class="form-group">
                    <label for="namaKategori">Nama Kategori</label>
                    <input type="text" class="form-control" id="namaKategori" name="namaKategori" required style="max-width: 400px;">
                </div>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
