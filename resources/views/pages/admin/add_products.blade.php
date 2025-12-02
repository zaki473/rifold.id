<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product - Rifold Admin</title>
    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Library SortableJS (Untuk fitur Drag & Drop) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    
    <style>
        /* Style tambahan agar visual drag lebih enak */
        .ghost { opacity: 0.5; background: #c8ebfb; }
        .drag-handle { cursor: grab; }
        .drag-handle:active { cursor: grabbing; }
        /* Badge Main Image */
        .main-tag { display: none; }
        #image-preview-container .preview-card:first-child .main-tag { display: block; }
        #image-preview-container .preview-card:first-child { border: 2px solid #4F46E5; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    @include('components.sidebar')

    <main class="ml-64 transition-all duration-300">
        @include('components.header_admin')

        <div class="p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Add New Product</h2>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">

                {{-- Beri ID pada form agar bisa kita manipulasi via JS --}}
                <form id="productForm" action="{{ route('store_products') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- GRID WRAPPER --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        {{-- Row 1 --}}
                        <div class="col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Product Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 outline-none" placeholder="Enter product name">
                        </div>
                        <div class="col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                            <input type="text" name="category" value="{{ old('category') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 outline-none" placeholder="e.g. Jacket">
                        </div>

                        {{-- Row 2 --}}
                        <div class="col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Price</label>
                            <input type="number" name="price" value="{{ old('price') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 outline-none" placeholder="0">
                        </div>
                        <div class="col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Size</label>
                            <input type="text" name="size" value="{{ old('size') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 outline-none" placeholder="S, M, L, XL">
                        </div>

                        {{-- Row 3 --}}
                        <div class="col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Stock</label>
                            <input type="number" name="stock" value="{{ old('stock') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
                        </div>
                        <div class="col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Color</label>
                            <input type="text" name="color" value="{{ old('color') }}" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 outline-none" placeholder="e.g. Black or #000000">
                            <p class="text-xs text-gray-500 mt-1">Gunakan B.Inggris (Black) atau Hex (#000) agar visual warna muncul.</p>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mt-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                        <textarea name="description" rows="5" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-indigo-500 focus:border-indigo-500 outline-none">{{ old('description') }}</textarea>
                    </div>

                    {{-- ========================================== --}}
                    {{-- AREA UPLOAD GAMBAR DENGAN PREVIEW & SORT --}}
                    {{-- ========================================== --}}
                    <div class="mt-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Product Images</label>
                        <p class="text-xs text-gray-500 mb-3">Foto pertama (paling kiri) akan menjadi <strong>Foto Utama (Main Image)</strong>. Geser (Drag) untuk mengubah urutan.</p>
                        
                        {{-- Area Upload --}}
                        <div class="mt-1 flex justify-center px-6 pt-10 pb-10 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 transition cursor-pointer relative" onclick="document.getElementById('file-upload').click()">
                            <div class="space-y-2 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
                                <div class="text-sm text-gray-600">
                                    <span class="font-medium text-indigo-600 hover:text-indigo-500">Click to upload</span>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG, WEBP allowed.</p>
                            </div>
                        </div>

                        {{-- Input File Tersembunyi --}}
                        <input id="file-upload" name="images[]" type="file" class="hidden" multiple accept="image/*">

                        {{-- Container Preview (Tempat Gambar Muncul) --}}
                        <div id="image-preview-container" class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                            <!-- Javascript akan mengisi ini -->
                        </div>
                    </div>

                    <div class="mt-10 flex justify-end gap-3">
                        <a href="{{ route('admin') }}" class="bg-gray-500 text-white font-semibold py-2.5 px-6 rounded-lg hover:bg-gray-600 transition">Cancel</a>
                        <button type="submit" class="bg-indigo-600 text-white font-semibold py-2.5 px-6 rounded-lg hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">Publish Product</button>
                    </div>
                </form>

            </div>
        </div>
    </main>

    {{-- SCRIPT DRAG & DROP LOGIC --}}
    <script>
        const fileInput = document.getElementById('file-upload');
        const previewContainer = document.getElementById('image-preview-container');
        let dt = new DataTransfer(); // Penampung file virtual biar bisa di-edit

        // 1. Saat user pilih file
        fileInput.addEventListener('change', function(e) {
            // Tambahkan file baru ke penampung
            for (let i = 0; i < this.files.length; i++) {
                dt.items.add(this.files[i]);
            }
            // Update visual
            renderPreview();
            // Update input file asli (untuk jaga-jaga)
            this.files = dt.files;
        });

        // 2. Fungsi Render Preview
        function renderPreview() {
            previewContainer.innerHTML = ''; // Reset container
            
            Array.from(dt.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.classList.add('preview-card', 'relative', 'group', 'rounded-lg', 'overflow-hidden', 'shadow-sm', 'border', 'border-gray-200', 'bg-white', 'cursor-move');
                    div.setAttribute('data-index', index); // Simpan index asli

                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-32 object-cover">
                        <!-- Badge Main Image -->
                        <div class="main-tag absolute top-2 left-2 bg-indigo-600 text-white text-[10px] font-bold px-2 py-1 rounded shadow-md">
                            MAIN IMAGE
                        </div>
                        <!-- Tombol Hapus -->
                        <button type="button" onclick="removeImage(${index})" class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    `;
                    previewContainer.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        }

        // 3. Fungsi Hapus Gambar dari Preview
        window.removeImage = function(index) {
            const newDt = new DataTransfer();
            Array.from(dt.files).forEach((file, i) => {
                if (i !== index) newDt.items.add(file);
            });
            dt = newDt;
            renderPreview();
        };

        // 4. Inisialisasi SortableJS (Fitur Drag & Drop)
        new Sortable(previewContainer, {
            animation: 150,
            ghostClass: 'ghost',
            onEnd: function() {
                // Saat user selesai geser-geser, kita harus update urutan file di 'dt'
                const newDt = new DataTransfer();
                const previewCards = previewContainer.querySelectorAll('.preview-card');
                
                // Ambil file berdasarkan urutan elemen HTML yang baru
                previewCards.forEach(card => {
                    const oldIndex = parseInt(card.getAttribute('data-index'));
                    newDt.items.add(dt.files[oldIndex]);
                });

                // Simpan urutan baru
                dt = newDt;
                // Render ulang biar index di tombol hapus & badge main image bener
                renderPreview(); 
            }
        });

        // 5. Saat Form Submit (Finalisasi)
        document.getElementById('productForm').addEventListener('submit', function() {
            // Masukkan data file yang sudah diurutkan ke input file asli
            fileInput.files = dt.files;
        });
    </script>

</body>
</html>