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
  <link rel="stylesheet" href="{{ asset('user-source/css/Homepage.css') }}">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">

  <!-- Preload images -->
  <link rel="preload" as="image" href="{{ asset('assets/images/Backgroung-Atas.jpg') }}">

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
      
        {{-- <a href="#" class="navbar-action-btn">Log In</a> --}}
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
    <section class="cart-section">
      <h2>INVOICE</h2>
      <!-- Detail pembeli -->
      <div class="cart-section">
        <div class="sorting-container">
          <div class="left">
            <label for="idorder">ID Order:</label>
            <select id="idorder" onchange="changeOrder(this)">
              @foreach($orders as $order)
              <option value="{{ $order->id }}" {{ $loop->first ? 'selected' : '' }}>{{ $order->id }}</option>
              @endforeach
            </select> 
          </div>
        </div>
        <!-- Dropdown ID Order -->
        <div class="product-list">
          <h4>Detail Pesanan</h4>
          <table class="cart-total-table">
            <tr>
                <td>ID Order</td>
                <td>{{ $order->id }}</td>
            </tr>
            <tr>
                <td>Tanggal Pemesanan</td>
                <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
            </tr>
            <tr>
                <td>Status Pemesanan</td>
                <td>{{ $order->order_status }}</td>
            </tr>
            <tr>
                <td>Status Pembayaran</td>
                <td>{{ $order->payment_status }}</td>
            </tr>
            <tr>
                <td>Metode Pembayaran</td>
                <td>{{ $order->payment_method }}</td>
            </tr>
            <tr>
              <td>Nomor Rekening</td>
            </tr>          
          </table>
        </div>
        <div class="customer-info">
          <h4>Informasi Pelanggan</h4>
          <table class="cart-total-table">
              <tr>
                  <td>Nama</td>
                  <td>{{ $order->name }}</td>
              </tr>
              <tr>
                  <td>Alamat</td>
                  <td>{{ $order->address }}</td>
              </tr>
              <tr>
                  <td>Kota</td>
                  <td>{{ $order->city }}</td>
              </tr>
              <tr>
                  <td>Provinsi</td>
                  <td>{{ $order->province }}</td>
              </tr>
              <tr>
                  <td>Kode Pos</td>
                  <td>{{ $order->postal_code }}</td>
              </tr>
              <tr>
                  <td>Telepon</td>
                  <td>{{ $order->phone }}</td>
              </tr>
              <tr>
                  <td>Email</td>
                  <td>{{ $order->email }}</td>
              </tr>
          </table>
        </div>
        <div class="cart-items-container">
          <table class="cart-table">
            <thead>
              <tr>
                <th>Produk</th>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="cart-items">
              @foreach ($order->items as $index => $item)
                      <tr>
                          <td>{{ $index + 1 }}</td>
                          <td>{{ $item->product->name }}</td>
                          <td>{{ $item->quantity }}</td>
                          <td>Rp. {{ number_format($item->product->price, 0, ',', '.') }}</td>
                          <td>Rp. {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                      </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="cart-total-section">
          <h3>Total Keranjang</h3>
          <table class="cart-total-table">
            <tr>
              <td>Subtotal</td>
              <td>Rp. {{ number_format($order->subtotal, 0, ',', '.') }}</td>
          </tr>
          <tr>
              <td>Ongkos Kirim</td>
              <td>Rp. {{ number_format($order->shipping_fee, 0, ',', '.') }}</td>
          </tr>
          <tr>
              <td><strong>Total</strong></td>
              <td><strong>Rp. {{ number_format($order->total, 0, ',', '.') }}</strong></td>
          </tr>
          </table>
          <button class="checkout">Pesanan Diterima</button>
        </div>
      <div style="clear: both"></div>
    </section>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
    const initialOrderId = document.getElementById('idorder').value;

    function loadOrderData(orderId) {
      fetch(`/transactions/ajax/${orderId}`, {
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Update detail pesanan
            document.querySelector('.product-list').innerHTML = `
              <h4>Detail Pesanan</h4>
              <table class="cart-total-table">
                <tr><td>ID Order</td><td>${data.order.id}</td></tr>
                <tr><td>Tanggal Pemesanan</td><td>${data.order.created_at}</td></tr>
                <tr><td>Status Pemesanan</td><td>${data.order.order_status}</td></tr>
                <tr><td>Status Pembayaran</td><td>${data.order.payment_status}</td></tr>
                <tr><td>Metode Pembayaran</td><td>${data.order.payment_method}</td></tr>
                ${data.order.payment_method === 'bca' ? '<tr><td>Nomor Rekening</td><td>39010895330834779</td></tr>' : ''}
              </table>
            `;

            // Update informasi pelanggan
            document.querySelector('.customer-info').innerHTML = `
              <h4>Informasi Pelanggan</h4>
              <table class="cart-total-table">
                <tr><td>Nama</td><td>${data.order.name}</td></tr>
                <tr><td>Alamat</td><td>${data.order.address}</td></tr>
                <tr><td>Kota</td><td>${data.order.city}</td></tr>
                <tr><td>Provinsi</td><td>${data.order.province}</td></tr>
                <tr><td>Kode Pos</td><td>${data.order.postal_code}</td></tr>
                <tr><td>Telepon</td><td>${data.order.phone}</td></tr>
                <tr><td>Email</td><td>${data.order.email}</td></tr>
              </table>
            `;

            // Update rincian produk
            const productRows = data.order.items.map((item, index) => `
              <tr>
                <td>${index + 1}</td>
                <td>${item.product.name}</td>
                <td>${item.quantity}</td>
                <td>Rp. ${new Intl.NumberFormat('id-ID').format(item.product.price)}</td>
                <td>Rp. ${new Intl.NumberFormat('id-ID').format(item.subtotal)}</td>
              </tr>
            `).join('');

            document.querySelector('.cart-table tbody').innerHTML = productRows;

            // Update ringkasan biaya
            document.querySelector('.cart-total-section').innerHTML = `
              <h4>Ringkasan Biaya</h4>
              <table class="cart-total-table">
                <tr><td>Subtotal</td><td>Rp. ${new Intl.NumberFormat('id-ID').format(data.order.subtotal)}</td></tr>
                <tr><td>Ongkos Kirim</td><td>Rp. ${new Intl.NumberFormat('id-ID').format(data.order.shipping_fee)}</td></tr>
                <tr><td><strong>Total</strong></td><td><strong>Rp. ${new Intl.NumberFormat('id-ID').format(data.order.total)}</strong></td></tr>
              </table>
              ${
                data.order.payment_status === 'Diterima' && data.order.order_status === 'Dikirim'
                  ? '<button class="checkout">Pesanan Diterima</button>'
                  : ''
              }
            `;
          }
        })
        .catch(error => console.error('Error:', error));
    }

    // Panggilan awal untuk memuat data order pertama
    loadOrderData(initialOrderId);

    // Event listener untuk perubahan pada dropdown ID order
    document.getElementById('idorder').addEventListener('change', function () {
      const selectedId = this.value;
      loadOrderData(selectedId);
    });
  });
  </script>
  
  <!-- 
    - #FOOTER
  -->

  <footer class="footer" style="background-image: url('{{ asset('user-source/images/footer-bg.jpg') }}')">
    <div class="footer-top section">
        <div class="container">
            <div class="footer-brand">
                <a href="#" class="logo">WF JAYA</a>
                <p class="footer-text">
                    Jika ada pertanyaan, Silahkan Hubungi Kami <a href="mailto:WFJaya@gmail.com" class="link">WFJaya@gmail.com</a>
                </p>
                <ul class="contact-list">
                    <li class="contact-item">
                        <ion-icon name="location-outline" aria-hidden="true"></ion-icon>
                        <address class="address">
                            Jalan Taman Safari II Pakukerto, Sukorejo, Pasuruan, Jawa Timur
                        </address>
                    </li>
                    <li class="contact-item">
                        <ion-icon name="call-outline" aria-hidden="true"></ion-icon>
                        <a href="tel:082112387637" class="contact-link">082112387637</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p class="copyright">
                &copy; 2024 Made with Kelompok 15 <a href="#" class="copyright-link">WF JAYA.</a>
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