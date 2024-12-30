@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Edit Produk</h1>
    <p class="mb-4">Edit detail produk yang diinginkan</p>

    <!-- Form -->
    <div class="card shadow mb-4" style="max-width: 500px; margin: 0 auto">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('produk.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- ID Produk -->
                <div class="form-group">
                    <label for="idProduk">ID Produk</label>
                    <input type="text" class="form-control" id="idProduk" name="idProduk" value="{{ $product->id }}" readonly>
                </div>

                <!-- Dropdown ID Kategori -->
                <div class="form-group">
                    <label for="jenis_category_id">Kategori</label>
                    <select class="form-control" id="jenis_category_id" name="jenis_category_id" required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($jenisCategories as $category)
                            <option value="{{ $category->id }}" 
                                {{ $product->jenis_category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Dropdown ID Hewan -->
                <div class="form-group">
                    <label for="animal_category_id">Hewan</label>
                    <select class="form-control" id="animal_category_id" name="animal_category_id" required>
                        <option value="">Pilih Hewan</option>
                        @foreach ($animalCategories as $category)
                            <option value="{{ $category->id }}" 
                                {{ $product->animal_category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Nama Produk -->
                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
                </div>

                <!-- Deskripsi -->
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ $product->description }}</textarea>
                </div>

                <!-- Harga -->
                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
                </div>

                <!-- Stok -->
                <div class="form-group">
                    <label for="stock">Stok</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" required>
                </div>

                <!-- Berat -->
                <div class="form-group">
                    <label for="berat">Berat (G)</label>
                    <input type="number" class="form-control" id="berat" name="berat" value="{{ $product->berat }}" step="0.1" required>
                </div>

                <!-- Gambar -->
                <div class="form-group">
                    <label for="image">Gambar</label>
                    <input type="file" class="form-control-file" id="gambar" name="image_url" accept="image/*" onchange="previewFile()">
                </div>

                <!-- Preview Gambar -->
                <div class="form-group">
                    <img id="preview" 
                        src="{{ $product->image_url ? asset('storage/' . $product->image_url) : '#' }}" 
                        alt="Preview Gambar" 
                        class="gmbrprd" 
                        style="{{ $product->image_url ? 'display: block;' : 'display: none;' }} max-width: 300px;">
                </div>

                <!-- Tombol Aksi -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End of Form -->
</div>

<script>
    function previewFile() {
        var preview = document.getElementById('preview');
        var file = document.getElementById('gambar').files[0];

        if (file) {
            if (file.type.startsWith('image/')) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    preview.src = event.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                alert('File yang dipilih bukan gambar. Silakan pilih file gambar.');
                document.getElementById('gambar').value = ""; // Reset input file
                preview.style.display = 'none'; // Sembunyikan gambar preview
                preview.src = "#";
            }
        } else {
            preview.style.display = 'none';
            preview.src = "#";
        }
    }
</script>
@endsection
