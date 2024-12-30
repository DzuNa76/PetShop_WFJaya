<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title', 'WF JAYA')</title>
    <meta name="description" content="@yield('meta_description', 'PetShop WF JAYA')" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('user-source/css/shop.css') }}" />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Bangers&family=Carter+One&family=Nunito+Sans:wght@400;700&display=swap"
      rel="stylesheet"
    />

    <!-- Preload Images -->
    <link rel="preload" as="image" href="{{ asset('assets/images/Backgroung-Atas.jpg') }}" />
  </head>

  <body id="top">
    <!-- Header -->
    @include('user.layouts.header')

    <!-- Main Content -->
    <main>
      @yield('content')
    </main>

    <!-- Footer -->
    @include('user.layouts.header')

    <!-- Back to Top -->
    <a href="#top" class="back-top-btn" aria-label="back to top">
      <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
    </a>

    <!-- JS -->
    <script src="{{ asset('assets/js/script.js') }}" defer></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </body>
</html>
