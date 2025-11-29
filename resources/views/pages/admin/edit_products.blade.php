<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Rifold Admin</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex bg-gray-100">

    @include('components.sidebar')

    <main class="flex-1 ml-64">
        @include('components.header_admin')
        <div class="p-8">

            {{-- Header dengan Judul --}}
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold">Edit Product</h2>

                {{-- TOMBOL DELETE (Ditaruh di pojok kanan atas form) --}}
                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded shadow hover:bg-red-600 transition">
                        Delete Product
                    </button>
                </form>
            </div>

            <div class="bg-white rounded-lg shadow p-6">

                {{-- FORM UPDATE --}}
                {{-- Perbaikan: Gunakan $product->id (bukan $products) --}}
                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        {{-- Product Name --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Products Name</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3">
                        </div>
                        {{-- Category --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Category</label>
                            <input type="text" name="category" value="{{ old('category', $product->category) }}" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3">
                        </div>
                        {{-- Price --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" name="price" value="{{ old('price', $product->price) }}" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3">
                        </div>
                        {{-- Size --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Size</label>
                            <input type="text" name="size" value="{{ old('size', $product->size) }}" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3">
                        </div>
                        {{-- Stock --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Stock</label>
                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3">
                        </div>
                        {{-- Color --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Color</label>
                            <input type="text" name="color" value="{{ old('color', $product->color) }}" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md py-2 px-3">{{ old('description', $product->description) }}</textarea>
                    </div>

                    {{-- Current Images Preview --}}
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                        @if(is_array($product->images) && count($product->images) > 0)
                            <div class="flex gap-2">
                                @foreach($product->images as $img)
                                    <img src="{{ asset('storage/' . $img) }}" class="w-20 h-20 object-cover rounded border">
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-sm">No image uploaded.</p>
                        @endif
                    </div>

                    {{-- Upload New Image --}}
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">Change Images (Optional)</label>
                        <input type="file" name="images[]" multiple class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        <p class="text-xs text-gray-500 mt-1">Leave empty if you don't want to change the image.</p>
                    </div>

                    {{-- Submit Button --}}
                    <div class="mt-8 flex justify-end">
                        <a href="{{ route('admin') }}" class="bg-gray-500 text-white font-semibold py-2 px-6 rounded-md hover:bg-gray-600 mr-2">Cancel</a>
                        <button type="submit" class="bg-indigo-600 text-white font-semibold py-2 px-6 rounded-md hover:bg-indigo-700">
                            Update Product
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </main>

</body>
</html>
