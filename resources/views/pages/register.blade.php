<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Rifold</title>
    
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
        {{-- KIRI: FORM REGISTER (CLEAN & BOXED STYLE) --}}
        {{-- ========================================== --}}
        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 lg:p-16 bg-white z-10 overflow-y-auto h-screen">
            <div class="w-full max-w-md space-y-8">
                
                {{-- Logo & Header --}}
                <div class="text-left">
                    <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tight text-black block mb-6">RIFOLD.</a>
                    <h1 class="text-3xl font-semibold text-gray-900">Create an account</h1>
                    <p class="text-gray-500 text-sm mt-2">Enter your details below to create your account and get started.</p>
                </div>

                {{-- Form Start --}}
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf 

                    {{-- Name Input --}}
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-black focus:border-black transition text-sm"
                            placeholder="Full name">
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email Input --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-black focus:border-black transition text-sm"
                            placeholder="name@example.com">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password Input --}}
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-black focus:border-black transition text-sm"
                            placeholder="••••••••">
                    </div>

                    {{-- Confirm Password Input --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-black focus:border-black transition text-sm"
                            placeholder="••••••••">
                    </div>

                    {{-- Terms & Conditions --}}
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-black focus:ring-black cursor-pointer">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="text-gray-500">I agree to the <a href="#" class="font-medium text-black hover:underline">Terms</a> and <a href="#" class="font-medium text-black hover:underline">Privacy Policy</a>.</label>
                        </div>
                    </div>

                    {{-- Tombol Signup --}}
                    <button type="submit" class="w-full bg-black text-white font-semibold py-3 rounded-lg hover:bg-gray-800 transition transform active:scale-[0.99] text-sm tracking-wide shadow-md mt-2">
                        Create Account
                    </button>
                </form>

                {{-- Footer Links --}}
                <div class="text-center text-sm text-gray-500 mt-6">
                    Already have an account? 
                    <a href="{{ route('loginpage') }}" class="font-semibold text-black hover:underline ml-1">Log in</a>
                </div>

            </div>
        </div>

        {{-- ========================================== --}}
        {{-- KANAN: GAMBAR AESTHETIC (CLOTHING BRAND COWOK) --}}
        {{-- ========================================== --}}
        <div class="hidden lg:block lg:w-1/2 relative overflow-hidden bg-gray-100">
            
            {{-- Gambar: Pria dengan style Clothing Brand --}}
           <img src="{{ asset('images/mix9.png') }}" 
                 alt="Rifold Men Collection" 
                 class="absolute inset-0 w-full h-full object-cover object-center">
            
            {{-- Gradient Overlay (Agar teks jelas) --}}
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>

            {{-- Big Typography --}}
            <div class="absolute bottom-0 left-0 p-16 w-full z-20">
                <h2 class="text-5xl lg:text-6xl font-bold text-white leading-tight mb-4 tracking-tight">
                    JOIN THE<br>
                    MOVEMENT.
                </h2>
                <p class="text-white/80 text-base font-light max-w-sm">
                    Be part of the story. Exclusive collections and new arrivals wait for you.
                </p>
            </div>
        </div>

    </div>

</body>
</html>