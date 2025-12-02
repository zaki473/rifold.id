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
            <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-black transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Beranda
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
                    <h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">Rp 169.900</h2>
                    <div class="inline-flex items-center px-4 py-1.5 rounded-full bg-gray-100 text-xs font-medium text-gray-600 border border-gray-200">
                        Order ID: #ORD-2023-8821
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
                    <form action="{{ route('home') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Hidden Input for Order ID if needed -->
                        <input type="hidden" name="order_id" value="ORD-2023-8821">

                        <div class="mb-6">
                            <label for="proof_image" class="relative block w-full border-2 border-dashed border-gray-300 rounded-2xl p-8 hover:bg-gray-50 hover:border-gray-400 transition cursor-pointer group" id="dropzone">
                                <input type="file" name="proof_image" id="proof_image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" onchange="previewImage(event)" required>

                                <!-- Default View -->
                                <div id="upload-placeholder" class="flex flex-col items-center justify-center space-y-3">
                                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-gray-200 transition">
                                        <svg class="w-6 h-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                    </div>
                                    <div class="text-center">
                                        <p class="text-sm font-medium text-gray-900">Klik untuk upload bukti transfer</p>
                                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, JPEG (Max 2MB)</p>
                                    </div>
                                </div>

                                <!-- Image Preview (Hidden by default) -->
                                <div id="image-preview-container" class="hidden relative w-full h-64 bg-gray-100 rounded-lg overflow-hidden">
                                    <img id="image-preview" src="#" alt="Bukti Transfer" class="w-full h-full object-contain">
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 hover:opacity-100 transition duration-200">
                                        <span class="text-white text-sm font-medium bg-black/50 px-4 py-2 rounded-full">Ganti Gambar</span>
                                    </div>
                                </div>
                            </label>
                        </div>

                        <button type="submit" class="w-full bg-black text-white font-bold text-lg py-4 rounded-xl hover:bg-gray-800 transition transform active:scale-[0.99] shadow-lg flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Kirim Bukti Pembayaran
                        </button>
                    </form>

                    <div class="mt-4">
                        <a href="#" class="text-sm text-gray-400 hover:text-gray-600">Saya belum transfer, kembali nanti</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="mt-20">
        @include('components.footer')
    </div>

    <!-- Scripts -->
    <script>
        // 1. Script Copy to Clipboard
        function copyToClipboard(elementId) {
            var copyText = document.getElementById(elementId).innerText;
            navigator.clipboard.writeText(copyText).then(function() {
                alert("Nomor rekening berhasil disalin!");
            });
        }

        // 2. Script Image Preview
        function previewImage(event) {
            const input = event.target;
            const placeholder = document.getElementById('upload-placeholder');
            const previewContainer = document.getElementById('image-preview-container');
            const previewImage = document.getElementById('image-preview');
            const dropzone = document.getElementById('dropzone');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    // Sembunyikan placeholder, tampilkan preview
                    placeholder.classList.add('hidden');
                    previewContainer.classList.remove('hidden');
                    // Ubah border dropzone jadi solid agar terlihat rapi
                    dropzone.classList.remove('border-dashed');
                    dropzone.classList.add('border-solid');
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // 3. Script Countdown Timer
        var timeLeft = 24 * 60 * 60;
        var timerElement = document.getElementById('countdown');

        setInterval(function() {
            var hours = Math.floor(timeLeft / 3600);
            var minutes = Math.floor((timeLeft % 3600) / 60);
            var seconds = timeLeft % 60;

            timerElement.textContent =
                (hours < 10 ? "0" + hours : hours) + ":" +
                (minutes < 10 ? "0" + minutes : minutes) + ":" +
                (seconds < 10 ? "0" + seconds : seconds);

            if (timeLeft > 0) timeLeft--;
        }, 1000);
    </script>
</body>
</html>
