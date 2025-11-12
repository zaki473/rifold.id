<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Rifold - Payment Confirmed</title>
</head>

<body class="bg-gray-100">

    @include('components.navbar')

    <div class="flex flex-col items-center justify-center min-h-screen text-center px-6">
        <div class="bg-white rounded-xl shadow-md p-10 max-w-lg w-full">
            <div class="text-green-600 text-6xl mb-4">✓</div>
            <h2 class="text-2xl font-semibold mb-2">Payment Confirmed</h2>
            <p class="text-gray-600 mb-6">
                Terima kasih telah membeli produk Rifold. Pesanan kamu sedang diproses, 
                dan akan dikirim sesuai alamat pengiriman.
            </p>

            <div class="space-x-4">
                <a href="{{ route('home') }}" class="bg-black text-white px-5 py-2 rounded-lg hover:bg-gray-800 transition">
                    Kembali ke Home
                </a>
                <a href="{{ route('katalog') }}" class="border border-black px-5 py-2 rounded-lg hover:bg-gray-100 transition">
                    Lihat Produk Lain
                </a>
            </div>
        </div>
    </div>

    @include('components.footer')

</body>
</html>
