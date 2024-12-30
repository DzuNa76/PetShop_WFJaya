<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>PetShop - WF JAYA</title>
    <meta name="title" content="PetShop - WF JAYA" />

    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml" />

    <link rel="stylesheet" href="{{ asset('user-source/css/detail.css') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    
    <link
      href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap"
      rel="stylesheet"
    />
    
    <!-- Preload images -->
    <link rel="preload" as="image" href="{{ asset('assets/images/Backgroung-Atas.jpg') }}">
  </head>

  <body id="top">
    <header class="header" data-header>
      <div class="container">
  
        <button class="nav-toggle-btn" aria-label="toggle menu" data-nav-toggler>
          <ion-icon name="menu-outline" aria-hidden="true" class="menu-icon"></ion-icon>
          <ion-icon name="close-outline" aria-label="true" class="close-icon"></ion-icon>
        </button>
  
        <a href="#" class="logo">WF JAYA</a>
  
        <nav class="navbar" data-navbar>
            <ul class="navbar-list">
                <li class="navbar-item">
                    <a href="{{ url('/indexuser') }}" class="navbar-link" data-nav-link>Home</a>
                </li>
                <li class="navbar-item">
                    <a href="{{ url('/shop') }}" class="navbar-link" data-nav-link>Shop</a>
                </li>
                <li class="navbar-item">
                    <a href="{{ url('/about') }}" class="navbar-link" data-nav-link>Tentang Kami</a>
                </li>
            </ul>
        </nav>
  
  
        <div class="header-actions">
          @if(auth()->check())
              <a href="{{ url('/cart') }}" class="action-btn" aria-label="cart">
                  <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
              </a>
          @else
              <a href="{{ route('user.login') }}" class="action-btn" aria-label="cart">
                  <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
              </a>
          @endif
  
          @if(auth()->check())
              <a href="{{ url('/profile') }}" class="action-btn" aria-label="profile">
                  <ion-icon name="person-outline" aria-hidden="true"></ion-icon>
              </a>
          @else
              <a href="{{ route('user.login') }}" class="action-btn" aria-label="profile">
                  <ion-icon name="person-outline" aria-hidden="true"></ion-icon>
              </a>
          @endif
          <!-- <a href="favorite.html" class="action-btn favorite" aria-label="Favorite">
            <ion-icon name="heart-outline" aria-hidden="true"></ion-icon>
          </a> -->
        </div>
  
      </div>
    </header>

    <main>
        <h1>Detail Produk</h1>
        <div id="notification" class="notification">
          @if(session('success'))
              <p class="notification-message">{{ session('success') }}</p>
          @endif
        </div>      
        <div class="main-container">
          <div class="product-image">
            <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}" class="main-image" />
          </div>
          <div class="product-details">
            <h2 class="product-title">{{ $product->name }}</h2>
            <div class="product-price">Rp.{{ number_format($product->price, 0, ',', '.') }}</div>
            <div class="product-stock">Stok: {{ $product->stock }}</div>
            {{-- <div class="product-quantity"> 
              <button type="button" onclick="updateQuantity(-1)">-</button> 
              <input type="text" id="quantity" name="quantity" value="1" readonly /> 
              <button type="button" onclick="updateQuantity(1)">+</button>
            </div> --}}
            @if($product->stock > 0)
                @if(auth()->check())
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="add-to-cart">Masukkan ke Keranjang</button>
                    </form>
                @else
                  <button class="add-to-cart" onclick="window.location.href='{{ route('user.login') }}'">Login untuk Menambahkan</button>
                @endif
            @else
                <button class="add-to-cart" disabled>Stok Habis</button>
            @endif

            <div class="short-description">
                <p>{{ $product->description }}</p>
                <p>Berat: {{ $product->berat }} Gram</p>
            </div>
          </div>
        </div>
    </main>
      

    <footer
        class="footer"
        style="background-image: url('{{ asset('user-source/images/footer-bg.jpg') }}')"
    >
        <div class="footer-top section">
        <div class="container">
            <div class="footer-brand">
            <a href="#" class="logo">WF JAYA</a>

            <p class="footer-text">
                Jika ada pertanyaan,Silahkan Hubungi Kami
                <a href="" class="link">WFJaya@gmail.com</a>
            </p>

            <ul class="contact-list">
                <li class="contact-item">
                <ion-icon name="location-outline" aria-hidden="true"></ion-icon>

                <address class="address">
                    Jalan Taman Safari II Pakukerto,Sukorejo,Pasuruan,Jawa Timur
                </address>
                </li>

                <li class="contact-item">
                <ion-icon name="call-outline" aria-hidden="true"></ion-icon>

                <a href="" class="contact-link">082112387637</a>
                </li>
            </ul>
            </div>
        </div>
        </div>

        <div class="footer-bottom">
        <div class="container">
            <p class="copyright">
            &copy; 2024 Made with Kelompok 15
            <a href="#" class="copyright-link">WF JAYA.</a>
            </p>
        </div>
        </div>
    </footer>

    <script src="{{ asset('user-source/js/script.js') }}"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
          const notification = document.getElementById('notification');
          if (notification.querySelector('.notification-message')) {
              notification.style.display = 'block';
  
              // Sembunyikan notifikasi setelah 3 detik
              setTimeout(() => {
                  notification.style.display = 'none';
              }, 3000);
          }
      });
    </script>
    <script> 
    function updateQuantity(amount) { 
      var quantityInput = document.getElementById('quantity'); 
      var quantity = parseInt(quantityInput.value); 
      var newQuantity = quantity + amount; 
      if (newQuantity > 0 && newQuantity <= {{ $product->stock }}) { 
        quantityInput.value = newQuantity; 
        document.getElementById('quantityInput').value = newQuantity; 
      } 
    }
    </script>    
    <script>
        document.getElementById('add-to-cart').addEventListener('click', function () {
            const productId = "{{ $product->id }}";
            const quantity = document.querySelector('.product-quantity input').value;
    
            fetch("{{ route('cart.add') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({ product_id: productId, quantity: quantity })
            })
            .then(response => {
                if (response.status === 401) {
                    alert('Silakan login terlebih dahulu');
                    window.location.href = "{{ route('login') }}";
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert(data.message);
                } else {
                    alert('Gagal menambahkan produk ke keranjang');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
    
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>
  </body>
</html>
