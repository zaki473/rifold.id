<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Rifold</title>
    
    {{-- TAILWIND CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- FONT POPPINS (Konsisten 1 Font) --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-white">

    <div class="min-h-screen flex w-full">
        
        {{-- ========================================== --}}
        {{-- KIRI: FORM LOGIN (CLEAN & BOXED STYLE) --}}
        {{-- ========================================== --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16 bg-white z-10 overflow-y-auto h-screen">
            <div class="w-full max-w-md space-y-8">
                
                {{-- Logo & Header --}}
                <div class="text-left">
                    <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tight text-black block mb-6">RIFOLD.</a>
                    <h1 class="text-3xl font-semibold text-gray-900">Welcome back</h1>
                    <p class="text-gray-500 text-sm mt-2">Please enter your details to sign in.</p>
                </div>

                {{-- Form Start --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf 

                    {{-- Email Input (Kotak Rapi - Sama dengan Register) --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-black focus:border-black transition text-sm"
                            placeholder="name@example.com">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password Input (Kotak Rapi) --}}
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-xs font-medium text-gray-500 hover:text-black transition">Forgot password?</a>
                            @endif
                        </div>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-black focus:border-black transition text-sm"
                            placeholder="••••••••">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol Login --}}
                    <button type="submit" class="w-full bg-black text-white font-semibold py-3 rounded-lg hover:bg-gray-800 transition transform active:scale-[0.99] text-sm tracking-wide shadow-md mt-2">
                        Sign In
                    </button>
                </form>

                {{-- Footer Links --}}
                <div class="text-center text-sm text-gray-500 mt-6">
                    Don't have an account? 
                    <a href="{{ route('registerpage') }}" class="font-semibold text-black hover:underline ml-1">Sign up for free</a>
                </div>

            </div>
        </div>

        {{-- ========================================== --}}
        {{-- KANAN: GAMBAR AESTHETIC (SENADA REGISTER) --}}
        {{-- ========================================== --}}
        <div class="hidden lg:block lg:w-1/2 relative overflow-hidden bg-gray-100">
            
            {{-- Gambar: Pria Casual/Streetwear (Clean) --}}
            <img src="{{ asset('images/mix16.png') }}" 
                 alt="Rifold Men Style" 
                 class="absolute inset-0 w-full h-full object-cover object-center">
            
            {{-- Gradient Overlay (Agar teks jelas) --}}
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>

            {{-- Big Typography --}}
            <div class="absolute bottom-0 left-0 p-16 w-full z-20">
                <h2 class="text-5xl lg:text-6xl font-bold text-white leading-tight mb-4 tracking-tight">
                    FOR THE<br>
                    STORIES AHEAD.
                </h2>
                <p class="text-white/80 text-base font-light max-w-sm">
                    Explore your everyday story with Rifold. Comfort meets style for every journey.
                </p>
            </div>
        </div>

    </div>

</body>
</html>