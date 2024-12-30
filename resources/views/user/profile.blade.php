<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PetShop - WF JAYA</title>
  <meta name="title" content="PetShop - WF JAYA">

  <link rel="shortcut icon" href="{{ asset('user-source/images/favicon.svg') }}" type="image/svg+xml">
  <link rel="stylesheet" href="{{ asset('user-source/css/profil.css') }}">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap"
    rel="stylesheet">

  <link rel="preload" as="image" href="{{ asset('user-source/images/Backgroung-Atas.jpg') }}">
</head>

<body id="top">
  <!-- HEADER -->
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
        @auth
          <a href="{{ url('/logout') }}" class="navbar-action-btn">Logout</a>
        @else
          <a href="{{ route('user.login') }}" class="navbar-action-btn">Log In</a>
        @endauth
      </nav>
      <div class="header-actions">
        <a href="{{ url('/cart') }}" class="action-btn" aria-label="cart">
          <ion-icon name="bag-handle-outline" aria-hidden="true"></ion-icon>
        </a>
        @auth
          <a href="{{ url('/profile') }}" class="action-btn" aria-label="profile">
            <ion-icon name="person-outline" aria-hidden="true"></ion-icon>
          </a>
        @endauth
      </div>
    </div>
  </header>

  <!-- MAIN -->
  <main>
    <h1>Profil Anda</h1>
    <div class="container">
      <div class="sidebar">
        <ul class="category-list">
          <li><a href="#main">Profil</a></li>
          <li><a href="{{ url('/transactions') }}">Transaksi</a></li>
          <li>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </div>
      <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
        @endif

        <form>
          <div class="user-info">
            <div class="user-profile">
              <p>Username: <input type="text" value="{{ auth()->user()->name }}" readonly></p>
              <p>Email: <input type="text" value="{{ auth()->user()->email }}" readonly></p>
              <p>Nomor Telepon: <input type="text" value="{{ auth()->user()->phone_number }}" readonly></p>
            </div>
          </div>
        </form>
        <a href="{{ route('user.editProfile') }}" class="btn btn-primary">Edit Profil</a>
        {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal">Edit Profil</button> --}}
      </div>
    </div>
    

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
  <script src="{{ asset('user-source/js/script.js') }}" defer></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

  
</body>
</html>
