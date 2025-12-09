<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Rifold - Upload Bukti Transfer</title>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    @include('components.navbar')

    <div class="container mx-auto px-4 md:px-6 py-12">
        <!-- Breadcrumb / Back -->
        <div class="max-w-3xl mx-auto mb-6">
            <a href="javascript:history.back()" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-black transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Payment
            </a>
        </div>

        <!-- Progress Indicator -->
        <div class="flex justify-center mb-10">
            <div class="flex items-center text-sm font-medium">
                <div class="flex items-center text-black opacity-60">
                    <span class="flex items-center justify-center w-6 h-6 bg-gray-200 text-gray-600 rounded-full text-xs mr-2">✓</span>
                    <span class="hidden sm:inline">Checkout</span>
                </div>
                <div class="w-8 sm:w-12 h-px bg-black opacity-20 mx-2 sm:mx-4"></div>
                <div class="flex items-center text-black">
                    <span class="flex items-center justify-center w-6 h-6 bg-blue-600 text-white rounded-full text-xs mr-2">
                         <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </span>
                    <span>Menunggu Pembayaran</span>
                </div>
            </div>
        </div>

        <!-- Main Content Center -->
        <div class="max-w-2xl mx-auto">

            <!-- Countdown Timer -->
            <div class="bg-orange-50 border border-orange-100 p-4 rounded-xl flex flex-col sm:flex-row items-center justify-between mb-6 text-center sm:text-left gap-2">
                <div class="flex items-center gap-3">
                    <svg class="w-6 h-6 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <span class="text-orange-800 font-medium text-sm">Selesaikan pembayaran sebelum pesanan dibatalkan otomatis</span>
                </div>
                <span class="font-bold text-orange-600 bg-white px-3 py-1 rounded-lg text-sm shadow-sm whitespace-nowrap" id="countdown">23:59:59</span>
            </div>

            <div class="bg-white p-6 sm:p-10 rounded-3xl shadow-sm border border-gray-100">

                <!-- Total Tagihan Center -->
                <div class="text-center mb-10">
                    <p class="text-sm text-gray-500 mb-2 uppercase tracking-wider font-medium">Total Tagihan</p>
                    <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">
                       Rp {{ number_format($order->total_price, 0, ',', '.') }}
                    </h2>

                    <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-gray-100 text-xs font-medium text-gray-600 border border-gray-200">
                        Order ID: #{{ $order->order_number }}
                    </div>
                </div>

                <!-- Bank Info Section -->
                <div class="space-y-4 mb-10">
                    <div class="bg-blue-50/50 p-6 rounded-2xl border border-blue-100">
                         <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-8 bg-blue-700 rounded flex items-center justify-center text-white font-bold text-xs italic tracking-wider shadow-sm">BCA</div>
                                <span class="font-semibold text-gray-900">Bank Central Asia</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between bg-white p-4 rounded-xl border border-gray-200 shadow-sm">
                            <span class="font-mono text-xl sm:text-2xl font-bold text-gray-800 tracking-wide" id="rek-bca">8270091234</span>
                            <button onclick="copyToClipboard('rek-bca')" class="text-sm text-blue-600 font-bold hover:bg-blue-50 px-3 py-1.5 rounded-lg transition-colors flex items-center gap-1">
                                Salin
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-3 ml-1">a.n <span class="font-semibold">PT Rifold Indonesia</span></p>
                    </div>
                </div>

                <div class="border-t border-gray-100 my-8"></div>

                <!-- Upload Section -->
                <div class="text-center">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Konfirmasi Pembayaran</h3>
                    <p class="text-sm text-gray-500 mb-6">Sudah melakukan transfer? Silakan unggah bukti transfer Anda di bawah ini.</p>

                    <!-- Form Upload -->
                    <!-- Pastikan route 'payment.upload' sudah ada di web.php -->
                    <form action="{{ route('payment.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Hidden Input for Order ID if needed -->
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
