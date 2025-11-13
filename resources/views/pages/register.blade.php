<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Started - Rifold</title>
    {{-- Memanggil Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <div class="container-split">
        {{-- Sisi Kiri - Panel Warna --}}
        <div class="color-panel"></div>

        {{-- Sisi Kanan - Konten Form --}}
        <div class="signup-container">
            <div class="signup-form">
                <div class="logo">RIFOLD</div>

                <div class="header">
                    <h1>Get Started Now</h1>
                </div>

                {{-- Form akan mengirim data ke route 'register' --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf {{-- Token Keamanan Laravel --}}

                    {{-- Input untuk Nama --}}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span style="color: red; font-size: 0.875rem; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Input untuk Email --}}
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required autocomplete="email">
                         @error('email')
                            <span style="color: red; font-size: 0.875rem; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Input untuk Password --}}
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Name" required autocomplete="new-password">
                        @error('password')
                            <span style="color: red; font-size: 0.875rem; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Persetujuan Syarat & Ketentuan --}}
                    <div class="terms-agree">
                        <input type="checkbox" id="terms" name="terms" required>
                        <label for="terms">I agree to the <a href="#">terms & policy</a></label>
                    </div>

                    <button type="submit" class="btn btn-primary">Signup</button>
                </form>


                <div class="login-link">
                    Have an account? <a href="{{ route('login') }}">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
