<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PetShop - WF JAYA</title>
    <meta name="title" content="PetShop - WF JAYA">

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/svg+xml">

    <link rel="stylesheet" href="{{ asset('user-source/css/Homepage.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">

    <link rel="preload" as="image" href="{{ asset('assets/images/Backgroung-Atas.jpg') }}">
</head>
<body id="top">

    <!-- HEADER -->
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
            <h2>KERANJANG BELANJA ANDA</h2>
            @if (empty($cartItems))
                <h2>KOSONG</h2>       
            @endif
            <div class="cart-items-container">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                            <th>Ubah</th>
                        </tr>
                    </thead>
                    <tbody id="cart-items">
                        @foreach ($cartItems as $item)
                        <tr data-id="{{ $item->id }}" data-price="{{ $item->price }}" data-stock="{{ $item->product->stock }}">
                            <td><img src="{{ asset('storage/' . $item->product->image_url) }}" alt="{{ $item->product->name }}"></td>
                            <td>{{ $item->product->name }}</td>
                        
                            <td>
                                <div class="quantity">
                                    <button class="minus" onclick="changeQuantity(this, -1)">-</button>
                                    <input type="number" value="{{ $item->quantity }}" min="1" onchange="updateSubtotal(this)">
                                    <button class="plus" onclick="changeQuantity(this, 1)">+</button>
                                </div>
                            </td>
                        
                            <td class="subtotal" data-subtotal="{{ $item->price * $item->quantity }}">
                                Rp. {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </td>                            
                        
                            <td>
                                <button class="checkout" style="background-color: red" onclick="removeItem(this)">Hapus</button>
                            </td>
                        </tr>                        
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="coupon-section">
                <button class="continue-shopping" onclick="window.location.href='{{ url('/shop') }}'">Lanjutkan Belanja</button>
            </div>
            <div class="cart-total-section">
                <h3>Total Keranjang</h3>
                <table class="cart-total-table">
                    <tr>
                        <td>Total</td>
                        <td id="cart-total" data-total="{{ $cartTotal }}">
                            Rp. {{ number_format($cartTotal, 0, ',', '.') }}
                        </td>
                    </tr>
                </table>
                <button class="checkout" onclick="window.location.href='{{ url('/checkout') }}'">Lanjutkan ke Checkout</button>
            </div>            
        </section>
    </main>

    <!-- FOOTER -->
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
    <!-- SCRIPTS -->
    <script>
        function updateCartTotal() {
            const subtotals = document.querySelectorAll('.subtotal'); // Semua subtotal
            let total = 0;

            // Iterasi subtotal dan hitung total
            subtotals.forEach(subtotalCell => {
                const subtotal = parseInt(subtotalCell.dataset.subtotal || 0); // Ambil nilai dari data-subtotal
                total += subtotal;
            });

            // Update total di elemen total keranjang
            const totalElement = document.getElementById('cart-total');
            totalElement.dataset.total = total; // Update data-total
            totalElement.textContent = `Rp. ${total.toLocaleString('id-ID')}`; // Format Rupiah
        }



        function updateSubtotal(input) {
            const row = input.closest('tr');
            const price = parseInt(row.dataset.price);
            const quantity = parseInt(input.value);
            const subtotalCell = row.querySelector('.subtotal');

            const subtotal = price * quantity;
            subtotalCell.dataset.subtotal = subtotal;
            subtotalCell.textContent = `Rp. ${subtotal.toLocaleString('id-ID')}`;

            // Update total keranjang
            updateCartTotal();
        }

        // Mengubah jumlah produk di keranjang
        function changeQuantity(button, change) {
            const row = button.closest('tr'); // Ambil elemen <tr>
            const input = row.querySelector('input[type="number"]'); // Input jumlah
            const currentQuantity = parseInt(input.value); // Jumlah saat ini
            const stock = parseInt(row.dataset.stock); // Stok produk
            const cartItemId = row.dataset.id; // ID keranjang

            // Hitung jumlah baru
            const newQuantity = currentQuantity + change;

            // Validasi: tidak boleh kurang dari 1 atau lebih besar dari stok
            if (newQuantity < 1) {
                alert('Jumlah tidak boleh kurang dari 1.');
                return;
            }
            if (newQuantity > stock) {
                alert(`Jumlah tidak boleh melebihi stok yang tersedia (${stock}).`);
                return;
            }

            // Perbarui nilai input sementara
            input.value = newQuantity;

            // Kirim permintaan AJAX untuk menyimpan perubahan
            fetch('{{ route('cart.update') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    cart_item_id: cartItemId,
                    quantity: newQuantity,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Update subtotal
                    const subtotalCell = row.querySelector('.subtotal');
                    subtotalCell.dataset.subtotal = data.subtotal;
                    subtotalCell.textContent = `Rp. ${data.subtotal.toLocaleString('id-ID')}`;

                    // Update total keranjang
                    updateCartTotal();
                } else {
                    alert(data.message);
                    input.value = currentQuantity; // Kembalikan jumlah awal jika gagal
                }
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
                input.value = currentQuantity; // Kembalikan jumlah awal jika gagal
            });
        }


        // Menghapus item dari keranjang
        function removeItem(button) {
            const row = button.closest("tr");
            const orderId = row.dataset.id;

            fetch('{{ route('cart.delete') }}', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    order_id: orderId
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'deleted') {
                    row.remove();
                    updateTotal();
                }
            });
        }

        // Mengupdate total keranjang
        function updateTotal() {
            const subtotals = document.querySelectorAll('.subtotal');
            let total = 0;

            subtotals.forEach(subtotal => {
                total += parseInt(subtotal.innerText.replace(/\D/g, ""));
            });

            document.getElementById('cart-total').innerText = `Rp. ${total.toLocaleString('id-ID')}`;
        }
    </script>

    <script src="{{ asset('user-source/js/script.js') }}" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>
