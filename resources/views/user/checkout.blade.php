<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- 
    - primary meta tag
  -->
  <title>PetShop - WF JAYA</title>
  <meta name="title" content="PetShop - WF JAYA">

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="{{ asset('user-source/css/detail.css') }}">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap"
    rel="stylesheet">

  <!-- 
    - preload images
  -->
  <link rel="preload" as="image" href="{{ asset('user-source/images/Backgroung-Atas.jpg') }}">

</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

    <header class="header" data-header>
        <div class="container">

            <button class="nav-toggle-btn" aria-label="toggle menu" data-nav-toggler>
                <ion-icon name="menu-outline" aria-hidden="true" class="menu-icon"></ion-icon>
                <ion-icon name="close-outline" aria-label="true" class="close-icon"></ion-icon>
            </button>

            <a href="{{ url('/indexuser') }}" class="logo">WF JAYA</a>
    
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
        <section class="checkout-section">
            <h2>Checkout</h2>
            <div class="checkout-container">
                <div class="card grid grid-1">
                    <h3>Info Pengiriman</h3>
                    <form id="checkoutForm" method="POST" action="{{ route('checkout.store') }}">
                        @csrf
                        <table class="transparent-table">
                            <tr>
                                <td colspan="2">
                                    <label for="name">Nama Lengkap:</label>
                                    <input type="text" name="name" required>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label for="address">Alamat:</label>
                                    <input type="text" name="address" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="city">Kota:</label>
                                    <input type="text" name="city" required>
                                </td>
                                <td>
                                    <label for="province">Provinsi/Kabupaten:</label>
                                    <input type="text" name="province" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="postal_code">Kode Pos:</label>
                                    <input type="text" name="postal_code" required>
                                </td>
                                <td>
                                    <label for="phone">Nomor Telepon:</label>
                                    <input type="text" name="phone" required>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <label for="message">Pesan untuk Penjual:</label>
                                    <textarea name="message"></textarea>
                                </td>
                            </tr>
                        </table>
                        <h3>Pilih Metode Pembayaran</h3>
                        <p>Transfer Virtual Account</p>
    
                        <div class="payment-option">
                            <label>
                                <input type="radio" name="bank" value="bca">
                                <span>VA BCA</span>
                                <img src="{{ asset('user-source/images/bca.jpg') }}" alt="Logo BCA" class="bank-logo">
                            </label>
                        </div>
    
                        <button type="button" class="order-button" onclick="showPopup()">Buat Pesanan</button>
                    </form>
                </div>
                <div class="card grid grid-2">
                    <h3>Orderan Anda</h3>
                    <table class="transparent-table">
                        @foreach ($cartItems as $item)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $item->product->image_url) }}" 
                                        alt="{{ $item->product->name }}" 
                                        class="product-image">
                                    <div>
                                        <p>{{ $item->product->name }}</p>
                                        <p>Jumlah: {{ $item->quantity }}</p>
                                    </div>
                                </td>
                                <td>Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <hr> <!-- Garis pemisah antar produk -->
                                </td>
                            </tr>
                        @endforeach
                    </table>
    
                    <div class="order-summary">
                        <p>Subtotal: <span class="price">Rp {{ number_format($subtotal, 0, ',', '.') }}</span></p>
                        <p>Total Berat: <span class="price">{{ number_format($totalWeightInGram / 1000, 2, ',', '.') }} kg</span></p>
                        <hr class="summary-separator">
                        <p>Ongkir: <span class="price">Rp {{ number_format($ongkir, 0, ',', '.') }}</span></p>
                        <hr class="summary-separator">
                        <p><strong>Total: <span class="price">Rp {{ number_format($total, 0, ',', '.') }}</span></strong></p>
                    </div>                    
                </div>
    
            </div>
    
            <!-- Pop-up Modal -->
            <div id="popup" class="popup">
                <div class="popup-content">
                    <span class="close" onclick="closePopup()">&times;</span>
                    <h3>Pemesanan berhasil segera lakukan pembayaran</h3>
                    <h3>Total Pembayaran</h3>
                    <p>Total: Rp {{ number_format($total, 0, ',', '.') }}</p>
                    <p>Bank: VA BCA</p>
                    <p>Nomor Rekening: 39010895330834779</p>
                    <button onclick="copyToClipboard()">Salin</button>
                </div>
            </div>
        </section>
    </main>
    
    <script>
    function showPopup() {
        // Tampilkan popup
        document.getElementById('popup').style.display = 'block';
    }
    
    function closePopup() {
        // Sembunyikan popup
        document.getElementById('popup').style.display = 'none';
    
        // Kirim form setelah popup ditutup
        document.getElementById('checkoutForm').submit();
    }
    
    function copyToClipboard() {
        const text = "39010895330834779"; // Nomor rekening yang akan disalin
        navigator.clipboard.writeText(text).then(() => {
            alert('Nomor rekening telah disalin ke clipboard: ' + text);
        }, (err) => {
            console.error('Gagal menyalin: ', err);
        });
    }
    </script>
    
  <!-- 
    - #FOOTER
  -->

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


  <!-- 
    - #BACK TO TOP
  -->

  <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
    <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  <script src="{{ asset('user-source/js/script.js') }}" defer></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>