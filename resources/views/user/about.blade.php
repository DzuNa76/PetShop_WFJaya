<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Primary meta tag -->
    <title>PetShop - WF JAYA</title>
    <meta name="title" content="PetShop - WF JAYA">

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- Custom CSS link -->
    <link rel="stylesheet" href="{{ asset('user-source/css/Homepage.css') }}">

    <!-- Google font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap" rel="stylesheet">

    <!-- Preload images -->
    <link rel="preload" as="image" href="{{ asset('assets/images/Backgroung-Atas.jpg') }}">
</head>

<body id="top">

    <!-- #HEADER -->
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
        <article>
            <section class="section hero has-bg-image" id="home" aria-label="home" style="background-image: url('{{ asset('user-source/images/Background-2.jpg') }}')">
                <div class="container">
                    <h1 class="h1 hero-title">
                        <span class="span">Semua yang Dibutuhkan</span>
                        <span class="span">dari Makanan hingga</span>
                        <span class="span">Aksesoris</span>
                    </h1>
                    <a href="{{ url('/') }}" class="btn">Pesan Sekarang</a>
                </div>
            </section>
            <div class="container">
                <div class="section-title">Tentang Toko Kami</div>
                <div class="content">
                    <p>"Selamat datang di WF Jaya, tempat di mana kami menyediakan segala kebutuhan hewan peliharaan Anda, mulai dari makanan berkualitas hingga aksesoris yang stylish. Kami berkomitmen untuk mendukung kesehatan dan kebahagiaan hewan kesayangan Anda dengan pilihan produk terbaik.</p>
                    <p>Di sini, Anda bisa menemukan beragam makanan bernutrisi serta aksesoris yang dirancang untuk kenyamanan dan gaya hewan peliharaan Anda. Kami percaya bahwa sahabat berbulu Anda layak mendapatkan yang terbaik."</p>
                </div>
                <div class="contact-section">
                    <div class="section-title">Silahkan Hubungi Kami</div>
                    <p>Kami selalu siap membantu Anda dan hewan peliharaan kesayangan Anda! Jika Anda memiliki pertanyaan mengenai produk makanan atau aksesoris, atau membutuhkan bantuan dalam memilih produk yang tepat, jangan ragu untuk menghubungi kami.</p>
                    <div class="contact-info">
                        <div><i class="fas fa-map-marker-alt"></i> Jalan Taman Safari II Prigen, Sukorejo, Pasuruan, Jawa Timur</div>
                        <div><i class="fas fa-envelope"></i> Wfjaya@gmail.com</div>
                        <div><i class="fas fa-phone"></i> +628118055690</div>
                        <div><i class="fas fa-clock"></i> Senin - Minggu : 6 Pagi sampai 5 Sore<br>Jum'at Libur</div>
                    </div>
                </div>
            </div>
            <section class="photo-gallery section" aria-label="Photo Gallery">
                <div class="container">
                    <h2 class="section-title">Gallery Toko Kami</h2>
                    <div class="gallery-grid"> 
                        <img src="{{ asset('user-source/images/about1.jpg') }}" alt="Pet Photo 1" class="gallery-photo"> 
                        <img src="{{ asset('user-source/images/about2.jpg') }}" alt="Pet Photo 2" class="gallery-photo"> 
                        <img src="{{ asset('user-source/images/about3.jpg') }}" alt="Pet Photo 3" class="gallery-photo"> 
                        <img src="{{ asset('user-source/images/about4.jpg') }}" alt="Pet Photo 4" class="gallery-photo"> 
                    </div>
                </div>
            </section>
        </article>
    </main>

    <script>
        document.querySelectorAll('.love-btn').forEach(button => {
            button.addEventListener('click', function() {
                this.classList.toggle('active'); // Toggel class active saat tombol ditekan
            });
        });
    </script>

    <!-- #FOOTER -->
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

    <!-- #BACK TO TOP -->
    <a href="#top" class="back-top-btn" aria-label="back to top" data-back-top-btn>
        <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
    </a>

    <!-- Custom JS link -->
    <script src="{{ asset('user-source/js/script.js') }}" defer></script>

    <!-- Ionicon link -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
