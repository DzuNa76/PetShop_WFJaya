@extends('user.layouts.main')

@section('title', 'Shop - WF JAYA')

@section('content')
<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Hewan</h2>
        <ul class="category-list">
            <li><a href="{{ url('/shop?hewan=all&jenis=' . request('jenis', 'all')) }}">Semua</a></li>
            @foreach($hewanCategories as $category)
              <li><a href="{{ url('/shop?hewan=' . $category->id . '&jenis=' . request('jenis', 'all')) }}">{{ $category->name }}</a></li>
            @endforeach
        </ul>          
    </div>
    <div class="product-list">
        <div class="sorting-container">
            <div class="left">
            <label for="jenis-category">Kategori Jenis:</label>
            <select id="jenis-category" name="jenis">
                <option value="all" {{ request('jenis') == 'all' ? 'selected' : '' }}>Semua</option>
                @foreach($jenisCategories as $jenis)
                <option value="{{ $jenis->id }}" {{ request('jenis') == $jenis->id ? 'selected' : '' }}>{{ $jenis->name }}</option>
                @endforeach
            </select>            
            </div>
        </div>  
    
        <!-- Daftar Produk -->
        <ul class="grid-list">
          @foreach($products as $product)
          <li>
            <div class="product-card" >
              <div class="card-banner img-holder">
                <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="img-cover default" />
              </div>
              <div class="card-content">
                <h3 class="h3">
                  <a href="{{ url('/shop/'.$product->id) }}" class="card-title">{{ $product->name }}</a>
                </h3>
                <data class="card-price">Rp.{{ number_format($product->price, 0, ',', '.') }}</data>
              </div>
            </div>
          </li>
          @endforeach
        </ul>
    </div>
  </div>
</div>

<script src="{{ asset('user-source/js/script.js') }}" defer></script>
<script>
document.getElementById('jenis-category').addEventListener('change', function () {
    const jenis = this.value; // Ambil nilai jenis yang dipilih
    const urlParams = new URLSearchParams(window.location.search);
    const hewan = urlParams.get('hewan') || 'all'; // Ambil filter kategori hewan dari URL

    // Jika memilih "Semua", set jenis ke 'all'
    if (jenis === 'all') {
        window.location.href = `/shop?hewan=${hewan}&jenis=all`;
    } else {
        // Redirect ke URL baru dengan filter yang dipilih
        window.location.href = `/shop?hewan=${hewan}&jenis=${jenis}`;
    }
});

</script>
@endsection
