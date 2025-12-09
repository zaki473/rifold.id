<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <title>Pembayaran QRIS - Rifold</title>
    <style>
        body { font-family: 'Poppins', sans-serif; }

        /* Animasi Timer */
        .text-urgent { color: #DC2626; animation: pulse 1s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: .5; } }

        /* Blur Effect */
        .qr-blur { filter: blur(8px); pointer-events: none; user-select: none; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    @include('components.navbar')

    <div class="container mx-auto px-4 md:px-6 py-10 max-w-6xl">

        <!-- Breadcrumb -->
        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-black transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        <!-- Progress Steps -->
        <div class="flex justify-center mb-10">
            <div class="flex items-center text-sm font-medium">
                <div class="flex items-center text-black opacity-60">
                    <span class="flex items-center justify-center w-6 h-6 bg-gray-200 text-gray-600 rounded-full text-xs mr-2">✓</span>
                    <span class="hidden sm:inline">Information</span>
                </div>
                <div class="w-8 sm:w-12 h-px bg-black opacity-20 mx-2 sm:mx-4"></div>
                <div class="flex items-center text-black opacity-60">
                    <span class="flex items-center justify-center w-6 h-6 bg-gray-200 text-gray-600 rounded-full text-xs mr-2">✓</span>
                    <span class="hidden sm:inline">Shipping</span>
                </div>
                <div class="w-8 sm:w-12 h-px bg-black mx-2 sm:mx-4"></div>
                <div class="flex items-center text-black">
                    <span class="flex items-center justify-center w-6 h-6 bg-black text-white rounded-full text-xs mr-2">3</span>
                    <span>Payment</span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-16 gap-8 items-start">

            <!-- LEFT COLUMN: QRIS & UPLOAD (CENTER FOCUS) -->
            <div class="lg:col-span-7">
                <div class="bg-white p-6 sm:p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center text-center">

                    <h2 class="text-2xl font-bold mb-2 text-gray-900">Scan QRIS</h2>
                    <p class="text-sm text-gray-500 mb-6 max-w-md">Silakan scan kode QR di bawah ini menggunakan aplikasi e-wallet atau mobile banking Anda.</p>

                    <div class="text-center mb-10">
                    <p class="text-sm text-gray-500 mb-2 uppercase tracking-wider font-medium">Total Tagihan</p>
                    <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                       Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </h2>

                    <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-gray-100 text-xs font-medium text-gray-600 border border-gray-200">
                        Order ID: #{{ $order->order_number }}
                    </div>
                </div>

                    <!-- Timer Countdown (Centered) -->
                    <div class="inline-flex items-center gap-2 bg-orange-50 text-orange-700 px-5 py-2 rounded-full font-medium text-sm mb-6 border border-orange-100 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>Sisa waktu: <strong id="countdown" class="tabular-nums text-lg">20:00</strong></span>
                    </div>

                    <!-- QR Code Area (Centered) -->
                    <div class="relative group mb-8">
                        <div id="qr-wrapper" class="p-4 border-2 border-dashed border-gray-200 rounded-2xl bg-white shadow-sm">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/Logo_QRIS.svg/1200px-Logo_QRIS.svg.png" alt="Logo QRIS" class="h-6 mx-auto mb-3 opacity-80">
                            {{-- Ganti URL ini dengan URL QRIS dinamis Anda --}}
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data=RifoldOrder-123"
                                 alt="QR Code"
                                 class="w-52 h-52 sm:w-60 sm:h-60 mx-auto mix-blend-multiply filter contrast-125">
                            <p class="text-xs text-gray-400 mt-2">NMID: ID123456789</p>
                        </div>

                        <!-- Expired Overlay -->
                        <div id="expired-overlay" class="hidden absolute inset-0 bg-white/95 backdrop-blur-sm z-20 flex-col items-center justify-center rounded-2xl">
                            <div class="bg-red-100 text-red-600 w-12 h-12 rounded-full flex items-center justify-center mb-3 animate-bounce">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </div>
                            <h3 class="text-gray-900 font-bold text-lg">Waktu Habis</h3>
                            <button onclick="window.location.reload()" class="mt-2 text-sm text-blue-600 font-medium hover:underline">Refresh Halaman</button>
                        </div>
                    </div>

                    <div class="w-full border-t border-gray-100 my-2"></div>

                    <!-- FORM UPLOAD BUKTI -->
                    {{-- Ganti action ke route controller yang menangani upload --}}
                    <form action="{{ route('payment.upload') }}" method="POST" enctype="multipart/form-data" class="w-full max-w-md mt-6">
    @csrf
    {{-- Input Hidden ID Order --}}
    <input type="hidden" name="order_id" value="{{ $order->id ?? '' }}">

    <div class="text-left mb-2">
        <label class="text-sm font-semibold text-gray-900">Upload Bukti Transaksi</label>
        <p class="text-xs text-gray-500">Kirim tangkapan layar (screenshot) bukti pembayaran berhasil.</p>
    </div>

    <!-- Upload Area -->
    <div class="mt-2 w-full">
        <label for="proof-file" class="flex flex-col items-center justify-center w-full h-40 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 hover:border-black transition-all group relative overflow-hidden">

            <!-- Placeholder Content -->
            <div id="upload-placeholder" class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg class="w-8 h-8 mb-3 text-gray-400 group-hover:text-black transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path></svg>
                <p class="mb-2 text-sm text-gray-500"><span class="font-semibold text-black">Klik untuk upload</span></p>
                <p class="text-xs text-gray-400">PNG, JPG or JPEG (MAX. 2MB)</p>
            </div>

            <!-- Image Preview -->
            <div id="image-preview-container" class="hidden absolute inset-0 w-full h-full bg-white flex-col items-center justify-center p-2">
                <img id="image-preview" src="#" alt="Preview" class="h-full object-contain rounded-md" />
                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <span class="text-white text-xs font-medium bg-black/50 px-3 py-1 rounded-full">Ganti Gambar</span>
                </div>
            </div>

            <input id="proof-file" name="payment_proof" type="file" class="hidden" accept="image/*" required onchange="previewAndEnableSubmit(event)" />
        </label>
    </div>

    <!-- Tombol Submit -->
    <div class="mt-6">
        <button type="submit" id="submit-btn" disabled class="w-full bg-black text-white font-bold py-4 rounded-xl hover:bg-gray-800 disabled:bg-gray-300 disabled:cursor-not-allowed transition transform active:scale-[0.99] shadow-lg flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            Konfirmasi & Kirim Bukti
        </button>
    </div>
</form>

<script>
function previewAndEnableSubmit(event) {
    const input = event.target;
    const placeholder = document.getElementById('upload-placeholder');
    const previewContainer = document.getElementById('image-preview-container');
    const previewImage = document.getElementById('image-preview');
    const submitBtn = document.getElementById('submit-btn');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            previewImage.src = e.target.result;
            placeholder.classList.add('hidden');
            previewContainer.classList.remove('hidden');
            submitBtn.disabled = false; // aktifkan tombol submit
        }

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</body>
</html>
