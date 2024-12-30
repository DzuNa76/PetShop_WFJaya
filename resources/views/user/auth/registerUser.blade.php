<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WF JAYA Register</title>
    <link rel="stylesheet" href="{{ asset('user-source/css/Login.css') }}">
</head>
<body>
    <div class="container">
        <div class="form-section">
            <div class="brand-logo">
                <h1>WF JAYA</h1>
            </div>
            <h1>Sign up</h1>

            <!-- Menampilkan error jika registrasi gagal -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('user.register') }}" method="POST">
                @csrf
                <label for="fullname">Nama Lengkap</label>
                <input type="text" id="fullname" name="name" placeholder="Masukkan nama lengkap Anda" value="{{ old('name') }}" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email Anda" value="{{ old('email') }}" required>

                <label for="phone">Nomor Telepon</label>
                <input type="tel" id="phone" name="phone_number" placeholder="Masukkan nomor telepon Anda" value="{{ old('phone_number') }}">

                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password Anda" required>

                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi password Anda" required>

                <button type="submit">Buat Akun</button>
                <div class="login-link">
                    Sudah Punya Akun? <a href="{{ route('user.login') }}">Login</a>
                  </div>
            </form>            
        </div>
        <div class="image-section">
            <img src="{{ asset('admin-source/img/Kucing-2.jpg') }}" alt="Cat Image">
        </div>
    </div>
</body>
</html>
