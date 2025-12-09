<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Rifold - Payment Confirmed</title>
    <style>
        body { font-family: 'Poppins', sans-serif; }
        @keyframes scaleUp {
            0% { transform: scale(0.5); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        .animate-pop {
            animation: scaleUp 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    @include('components.navbar')

    <div class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12 max-w-md w-full text-center">

            <div class="animate-pop mx-auto w-24 h-24 bg-green-50 rounded-full flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h2 class="text-3xl font-bold text-gray-900 mb-2">Pembayaran Berhasil!</h2>
                <p class="text-sm text-gray-400 font-medium mb-6 uppercase tracking-wide">
                    ID Pesanan: #{{ $order->order_number }}
                </p>
            <p class="text-gray-600 mb-8 leading-relaxed">
                Terima kasih telah membeli produk Rifold. Pesanan kamu sedang diproses
                dan akan segera dikirim ke alamat tujuan.
            </p>

            <div class="flex flex-col gap-3">
                <a href="{{ route('katalog') }}" class="w-full bg-black text-white font-medium px-6 py-3.5 rounded-xl hover:bg-gray-800 transition shadow-lg active:scale-[0.99]">
                    Belanja Lagi
                </a>
                <a href="{{ route('home') }}" class="w-full bg-white text-gray-700 font-medium px-6 py-3.5 rounded-xl border border-gray-200 hover:bg-gray-50 hover:text-black transition">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
    @include('components.footer')
</body>
</html>
