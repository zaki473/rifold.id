<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rifold</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>

    <div class="container-split">
        <div class="login-container">
            <div class="login-form">
                <div class="logo">RIFOLD</div>

                <div class="welcome-header">
                    <h1>Welcome back!</h1>
                    <p>Enter your Credentials to access your account</p>
                </div>

                {{-- Form akan mengirim data ke route 'login' di Laravel --}}
                <form method="POST" action="{{ route('home') }}">
                    @csrf {{-- Token keamanan Laravel --}}

                    <div class="form-group">
                        <label for="email">Email address</label>
                        {{-- 'old('email')' untuk menjaga nilai input jika ada error validasi --}}
                        <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        {{-- Contoh menampilkan error validasi --}}
                        @error('email')
                            <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="password-label">
                            <label for="password">Password</label>
                        </div>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Name" required>
                         @error('password')
                            <span style="color: red; font-size: 0.875rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>
                </form>

                <div class="signup-link">
                    Don't have an account? <a href="{{ route('register') }}">Sign Up</a>
                </div>
            </div>
        </div>

        <div class="color-panel">
            {{-- Panel ini sengaja dikosongkan untuk desain --}}
        </div>
    </div>

</body>
</html>
