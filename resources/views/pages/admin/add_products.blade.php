<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Rifold Admin</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex bg-gray-100">

    @include('components.sidebar')

    <main class="flex-1 ml-64">
        @include('components.header_admin')
        <div class="p-8">
            <h2 class="text-2xl font-semibold mb-4">Add New Product</h2>
            <div class="bg-white rounded-lg shadow p-6">

                {{-- FORM CREATE (TAMBAH) --}}
                {{-- Perbedaan 1: Action ke store_products, Method POST biasa --}}
                <form action="{{ route('store_products') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Perbedaan 2: Tidak ada @method('PUT') --}}

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        {{-- Product Name --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Product Name</label>
                            {{-- Perbedaan 3: Value kosong atau old('name') saja, tidak pakai $product --}}
                            <input type="text" name="name" value="{{ old('name') }}" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3" placeholder="Enter product name">
                        </div>
                        {{-- Category --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Category</label>
                            <input type="text" name="category" value="{{ old('category') }}" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3" placeholder="e.g. Jacket">
                        </div>
                        {{-- Price --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" name="price" value="{{ old('price') }}" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3" placeholder="0">
                        </div>
                        {{-- Size --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Size</label>
                            <input type="text" name="size" value="{{ old('size') }}" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3" placeholder="S, M, L, XL">
                        </div>
                        {{-- Stock --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Stock</label>
                            <input type="number" name="stock" value="{{ old('stock') }}" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3">
                        </div>
                        {{-- Color --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Color</label>
                            <input type="text" name="color" value="{{ old('color') }}" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3" placeholder="e.g. Black">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3">{{ old('description') }}</textarea>
                    </div>

                    {{-- Upload Images --}}
                    {{-- Perbedaan 4: Tidak ada preview gambar lama --}}
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">Product Images</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none">
                                        <span>Click to upload</span>
                                        <input id="file-upload" name="images[]" type="file" class="sr-only" multiple>
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG allowed.</p>
                            </div>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="mt-8 flex justify-end">
                        <a href="{{ route('admin') }}" class="bg-gray-500 text-white font-semibold py-2 px-6 rounded-md hover:bg-gray-600 mr-2">Cancel</a>
                        <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-md hover:bg-indigo-700">
                            Publish Product
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </main>

</body>
</html>
