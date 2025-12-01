<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rifold Dashboard Admin - Edit Mix And Match</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
    </style>
</head>
<body class="flex bg-gray-100">
    @include('components.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 ml-64">
        @include('components.header_admin')
        <div class="p-8">
            <h2 class="text-2xl font-semibold mb-4">Edit Mix and Match</h2>

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
                <h3 class="text-xl font-semibold mb-4 border-b pb-4">Edit Data</h3>

                {{-- FORM EDIT --}}
                <form action="{{ route('mixandmatch.update', $mixAndMatch->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- Wajib untuk Update data di Laravel --}}

                    {{-- 1. Input Nama (Value diambil dari database) --}}
                    <div class="mb-6">
                        <label for="images_name" class="block text-sm font-medium text-gray-700 mb-2">Mix Name</label>
                        <input type="text" name="images_name" id="images_name"
                               value="{{ old('images_name', $mixAndMatch->name) }}"
                               class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                    </div>

                    {{-- 2. Preview Gambar Lama --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Images</label>
                        <div class="flex space-x-4 overflow-x-auto p-2 border rounded-md bg-gray-50">
                            @php
                                $images = json_decode($mixAndMatch->images_path);
                            @endphp

                            @if($images)
                                @foreach($images as $img)
                                    <div class="relative w-24 h-24 flex-shrink-0">
                                        <img src="{{ asset('storage/' . $img) }}" alt="Current Image" class="w-full h-full object-cover rounded-md border border-gray-300">
                                    </div>
                                @endforeach
                            @else
                                <span class="text-gray-400 text-sm">No images uploaded.</span>
                            @endif
                        </div>
                    </div>

                    {{-- 3. Input Upload Gambar Baru --}}
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700">Update Images (Leave empty to keep current)</label>
                        <div class="mt-1 flex justify-center px-6 pt-10 pb-10 border-2 border-gray-300 border-dashed rounded-md hover:bg-gray-50 transition-colors relative">
                            <div class="space-y-1 text-center">
                                <div class="mx-auto h-12 w-12 text-gray-400 bg-gray-100 rounded-full flex items-center justify-center">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11v6m0 0l-3-3m3 3l3-3"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v8"></path>
                                    </svg>
                                </div>
                                <div class="flex text-sm text-gray-600 justify-center">
                                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-black hover:text-indigo-500 focus-within:outline-none">
                                        <span class="font-bold">Click to upload new images</span>
                                        <input id="file-upload" name="images[]" type="file" class="sr-only" multiple onchange="showFileNames(this)">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-500">Uploading new images will replace the old ones.</p>
                                <p id="file-list" class="text-sm text-indigo-600 mt-2 font-semibold"></p>
                            </div>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="mt-8 flex justify-end gap-3">
                        <a href="{{ route('mixandmatch.index') }}" class="bg-gray-200 text-gray-700 font-semibold py-2 px-6 rounded-md hover:bg-gray-300">
                            Cancel
                        </a>
                        <button type="submit" class="bg-blue-600 text-white font-semibold py-2 px-6 rounded-md hover:bg-blue-700 transition-colors">
                            Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        function showFileNames(input) {
            const fileList = document.getElementById('file-list');
            if (input.files.length > 0) {
                let names = [];
                for (let i = 0; i < input.files.length; i++) {
                    names.push(input.files[i].name);
                }
                fileList.textContent = 'Selected New: ' + names.join(', ');
            } else {
                fileList.textContent = '';
            }
        }
    </script>
</body>
</html>
