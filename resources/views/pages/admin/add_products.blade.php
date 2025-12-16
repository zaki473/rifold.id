<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rifold Dashboard Admin - Add Product</title>

    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>

    <style>
        body {
            background-color: #f4f7f6;
        }

        .ghost {
            opacity: 0.5;
            background: #e0e7ff;
            border: 2px dashed #6366f1;
        }

        .main-tag {
            display: none;
        }

        #image-preview-container .preview-card:first-child .main-tag {
            display: block;
        }

        #image-preview-container .preview-card:first-child {
            border: 2px solid #4F46E5;
        }
    </style>
</head>

<body class="flex bg-gray-100">
    @include('components.sidebar')

    {{-- MAIN CONTENT --}}
    <main class="flex-1 ml-64">
        @include('components.header_admin')

        <div class="p-8">
            <h2 class="text-2xl font-semibold mb-4">Add New Product</h2>

            {{-- ERROR VALIDASI --}}
            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-4 border-b pb-4">New Product Data</h3>

                <form id="productForm" action="{{ route('store_products') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Product Name --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-2">Product Name</label>
                            <input type="text" name="name" class="w-full p-3 border rounded-md" required>
                        </div>

                        {{-- Category --}}
                        <div class="col-span-1">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                            {{-- GANTI INPUT TEXT JADI SELECT OPTION --}}
                            <div class="relative">
                                <select name="category"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition appearance-none bg-white">
                                    <option value="" disabled selected>Select Category</option>
                                    {{-- Value harus huruf kecil, sesuai dengan value di filter katalog --}}
                                    <option value="flannel" {{ old('category') == 'flannel' ? 'selected' : '' }}>Flannel
                                        Shirts</option>
                                    <option value="jacket" {{ old('category') == 'jacket' ? 'selected' : '' }}>Jackets
                                    </option>
                                    <option value="polo" {{ old('category') == 'polo' ? 'selected' : '' }}>Polo Shirts
                                    </option>
                                    <option value="tshirt" {{ old('category') == 'tshirt' ? 'selected' : '' }}>T-Shirts
                                    </option>
                                </select>
                                <!-- Panah dropdown kustom -->
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path
                                            d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- Size --}}
                        <div>
                            <label class="block text-sm font-medium mb-2">Size</label>
                            <input type="text" name="size" class="w-full p-3 border rounded-md">
                        </div>

                        {{-- Price --}}
                        <div>
                            <label class="block text-sm font-medium mb-2">Price</label>
                            <input type="number" name="price" class="w-full p-3 border rounded-md" required>
                        </div>

                        {{-- Stock --}}
                        <div>
                            <label class="block text-sm font-medium mb-2">Stock</label>
                            <input type="number" name="stock" class="w-full p-3 border rounded-md" required>
                        </div>

                        {{-- Color --}}
                        <div>
                            <label class="block text-sm font-medium mb-2">Color</label>
                            <input type="text" name="color" class="w-full p-3 border rounded-md">
                        </div>

                        {{-- Mix & Match --}}
                        <div>
                            <label class="block text-sm font-medium mb-2">Mix & Match</label>
                            <select name="mix_and_match_id" class="w-full p-3 border rounded-md">
                                <option value="">-- Tidak termasuk --</option>
                                @foreach ($mixAndMatches as $mix)
                                    <option value="{{ $mix->id }}">{{ $mix->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Description --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-2">Description</label>
                            <textarea name="description" rows="4" class="w-full p-3 border rounded-md"
                                required></textarea>
                        </div>

                        {{-- Images --}}
                        <div class="md:col-span-2 mt-4">
                            <label class="block text-sm font-medium mb-2">Product Images</label>

                            <div class="mt-1 flex justify-center px-6 pt-10 pb-10 border-2 border-gray-300 border-dashed rounded-md hover:bg-gray-50 transition-colors relative cursor-pointer"
                                onclick="document.getElementById('file-upload').click()">

                                <div class="space-y-1 text-center">
                                    <div
                                        class="mx-auto h-12 w-12 text-gray-400 bg-gray-100 rounded-full flex items-center justify-center">
                                        📷
                                    </div>

                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="file-upload" class="relative cursor-pointer font-bold">
                                            Click to upload
                                            <input id="file-upload" name="images[]" type="file" class="sr-only"
                                                multiple>
                                        </label>
                                        <p class="pl-1">or drag & drop</p>
                                    </div>
                                </div>
                            </div>

                            <div id="image-preview-container" class="grid grid-cols-2 md:grid-cols-5 gap-4 mt-4"></div>
                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <div class="mt-8 flex justify-end">
                        <button type="submit"
                            class="bg-gray-800 text-white font-semibold py-2 px-6 rounded-md hover:bg-gray-900 transition">
                            Publish Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    {{-- IMAGE PREVIEW + SORT --}}
    <script>
        const fileInput = document.getElementById('file-upload');
        const previewContainer = document.getElementById('image-preview-container');
        let dt = new DataTransfer();

        fileInput.addEventListener('change', function () {
            for (let i = 0; i < this.files.length; i++) {
                dt.items.add(this.files[i]);
            }
            renderPreview();
            this.files = dt.files;
        });

        function renderPreview() {
            previewContainer.innerHTML = '';
            Array.from(dt.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const div = document.createElement('div');
                    div.classList.add('preview-card', 'relative', 'rounded-md', 'overflow-hidden', 'shadow', 'border');
                    div.setAttribute('data-index', index);

                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-32 object-cover">
                        <div class="main-tag absolute top-1 left-1 bg-indigo-600 text-white text-xs px-2 py-1 rounded">MAIN</div>
                        <button type="button" onclick="removeImage(${index})"
                            class="absolute top-1 right-1 bg-white text-red-600 rounded-full px-2">X</button>
                    `;
                    previewContainer.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        }

        function removeImage(index) {
            const newDt = new DataTransfer();
            Array.from(dt.files).forEach((file, i) => {
                if (i !== index) newDt.items.add(file);
            });
            dt = newDt;
            renderPreview();
        }

        new Sortable(previewContainer, {
            animation: 150,
            ghostClass: 'ghost',
            onEnd() {
                const newDt = new DataTransfer();
                previewContainer.querySelectorAll('.preview-card').forEach(card => {
                    newDt.items.add(dt.files[card.dataset.index]);
                });
                dt = newDt;
                renderPreview();
            }
        });

        document.getElementById('productForm').addEventListener('submit', function () {
            fileInput.files = dt.files;
        });
    </script>
</body>

</html>