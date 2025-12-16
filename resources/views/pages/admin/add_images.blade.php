<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Content Image - Rifold Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

    @include('components.sidebar')

    <main class="ml-64 transition-all duration-300">
        @include('components.header_admin')

        <div class="p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Add New Banner</h2>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">

                <form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        
                        {{-- KOLOM KIRI: FORM INPUT --}}
                        <div class="lg:col-span-1 space-y-6">
                            
                            {{-- Input Name --}}
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Image Title / Name</label>
                                <input type="text" name="images_name" 
                                       class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition"
                                       placeholder="e.g. Hero Banner 1" required>
                                <p class="text-xs text-gray-500 mt-2">Nama ini digunakan untuk identifikasi gambar di list admin.</p>
                            </div>

                            {{-- Info Banner --}}
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <h4 class="text-sm font-bold text-blue-800 mb-1">Tips Ukuran Gambar</h4>
                                <p class="text-xs text-blue-600 leading-relaxed">
                                    Agar tampilan Home maksimal, gunakan gambar dengan rasio <strong>Landscape (16:9)</strong> atau <strong>Portrait (4:5)</strong> dengan kualitas tinggi (HD).
                                </p>
                            </div>

                        </div>

                        {{-- KOLOM KANAN: UPLOAD & PREVIEW --}}
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Image</label>
                            
                            {{-- Area Upload --}}
                            <div class="relative w-full h-80 border-2 border-dashed border-gray-300 rounded-xl hover:bg-gray-50 transition flex flex-col justify-center items-center cursor-pointer overflow-hidden group"
                                 onclick="document.getElementById('imageInput').click()">
                                
                                {{-- Preview Image (Awalnya Hidden) --}}
                                <img id="preview" class="hidden absolute inset-0 w-full h-full object-cover rounded-xl z-10">

                                {{-- Placeholder Icon & Text --}}
                                <div id="placeholder" class="text-center p-6">
                                    <div class="w-16 h-16 bg-indigo-50 text-indigo-500 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <p class="text-sm font-medium text-gray-900">Click to upload image</p>
                                    <p class="text-xs text-gray-500 mt-1">PNG, JPG, WEBP up to 2MB</p>
                                </div>

                                {{-- Overlay saat ada gambar (Tombol Ganti) --}}
                                <div id="overlay" class="hidden absolute inset-0 bg-black/50 z-20 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">
                                    <p class="text-white font-semibold">Click to change image</p>
                                </div>
                            </div>

                            {{-- Input File Hidden --}}
                            <input type="file" name="image" id="imageInput" class="hidden" accept="image/*" onchange="previewImage(event)">
                        </div>

                    </div>

                    {{-- Footer Buttons --}}
                    <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-3">
                        <a href="{{ route('images.index') }}" class="bg-gray-500 text-white font-semibold py-2.5 px-6 rounded-lg hover:bg-gray-600 transition">
                            Cancel
                        </a>
                        <button type="submit" class="bg-indigo-600 text-white font-semibold py-2.5 px-6 rounded-lg hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">
                            Save Banner
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </main>

    {{-- Script untuk Preview Gambar --}}
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('preview');
            const placeholder = document.getElementById('placeholder');
            const overlay = document.getElementById('overlay');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden'); // Tampilkan gambar
                    placeholder.classList.add('hidden'); // Sembunyikan teks placeholder
                    overlay.classList.remove('hidden');  // Aktifkan overlay hover
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

</body>
</html>