<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WF JAYA Login</title>
    <link rel="stylesheet" href="{{ asset('user-source/css/Login.css') }}">
</head>
<body>
    <div class="container">
        <div class="form-section">
            <div class="brand-logo">
                <h1>WF JAYA</h1>
            </div>
            <h1>Login</h1>

            <!-- Menampilkan error jika login gagal -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.login') }}" method="POST">
                @csrf
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email Anda" value="{{ old('email') }}" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>

                <button type="submit">Login</button>
                
                <div class="sign-up-link">
                    Tidak Punya Akun? <a href="{{ route('user.register') }}">Sign up</a>
                </div>
            </form>         
            <div class="visit-shop">
                <p>Atau kunjungi shop kami tanpa login:</p>
                <a href="{{ url('/indexuser') }}" class="btn-shop">Kunjungi Shop</a>
            </div>            
        </div>
        <div class="image-section">
            <img src="{{ asset('admin-source/img/kucing-1.jpg') }}" alt="Cat Image">
        </div>
    </div>
</body>
</html>
