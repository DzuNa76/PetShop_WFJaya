<header class="header" data-header>
    <div class="container">
      <button class="nav-toggle-btn" aria-label="toggle menu" data-nav-toggler>
        <ion-icon name="menu-outline" aria-hidden="true" class="menu-icon"></ion-icon>
        <ion-icon name="close-outline" aria-hidden="true" class="close-icon"></ion-icon>
      </button>
  
      <a href="#" class="logo">WF JAYA</a>
  
      <nav class="navbar" data-navbar>
        <ul class="navbar-list">
          <li class="navbar-item"><a href="{{ url('/indexuser') }}" class="navbar-link" data-nav-link>Home</a></li>
          <li class="navbar-item"><a href="{{ url('/shop') }}" class="navbar-link" data-nav-link>Shop</a></li>
          <li class="navbar-item"><a href="{{ url('/about') }}" class="navbar-link" data-nav-link>Tentang Kami</a></li>
        </ul>
        <a href="{{ url('/login') }}" class="navbar-action-btn">Log In</a>
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
  