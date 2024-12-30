@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Edit Kategori</h1>

    <!-- Form -->
    <div class="card shadow mb-4" style="max-width: 400px; margin: 0 auto;">
        <div class="card-body">
            <form action="{{ route('kategori.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nama Kategori</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}" required>
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
