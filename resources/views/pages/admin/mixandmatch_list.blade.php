<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rifold Dashboard Admin - Products</title>
    {{-- Tambahkan link ke file CSS Anda di sini --}}
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Anda bisa menambahkan CSS kustom di sini jika diperlukan */
        body {
            background-color: #f4f7f6;
        }
        .active {
            background-color: #eef2f5;
            font-weight: bold;
        }
    </style>
</head>
<body class="flex bg-gray-100">

    @include('components.sidebar')
    {{-- Main Content --}}
    <main class="flex-1 ml-64">
        @include('components.header_admin')
        <div class="p-8">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-semibold">Mix And Match</h2>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-xl font-semibold mb-4">Mix And Match list</h3>
                <div class="mb-4">
                    <input type="text" placeholder="Search........" class="w-full p-2 border border-gray-300 rounded-md">
                </div>
                <table class="w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left p-3">Mix And Match</th>
                            <th class="text-left p-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- MULAI LOOPING DATA --}}
                        @forelse($mixAndMatches as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3 flex items-center">
                                    {{-- Menampilkan Gambar Pertama dari JSON --}}
                                    @php
                                        $images = json_decode($item->images_path);
                                        $firstImage = $images[0] ?? null;
                                    @endphp

                                    @if($firstImage)
                                        <img src="{{ asset('storage/' . $firstImage) }}" alt="Product Image" class="w-10 h-10 rounded-md mr-4 object-contain">
                                    @else
                                        <div class="w-10 h-10 rounded-md mr-4 bg-gray-200"></div>
                                    @endif

                                    <span>{{ $item->name }}</span>
                                </td>
                                <td class="p-3">
                                    {{-- Update href tombol edit --}}
                                    <a href="{{ route('mixandmatch.edit', $item->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors inline-block">
                                        Edit
                                    </a>

                                    <form action="{{ route('mixandmatch.destroy', $item->id) }}" method="POST" class="inline-block"
                                        onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors">
                                            Delete
                                        </button>
                                    </form>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="p-3 text-center text-gray-500">No data available</td>
                            </tr>
                        @endforelse
                        {{-- AKHIR LOOPING DATA --}}
                    </tbody>
                </table>
                {{-- Paginasi --}}
                <div class="mt-6 flex justify-end items-center">
                   {{ $mixAndMatches->links('pagination::tailwind') }}
                </div>
            </div>
        </div>
    </main>

</body>
</html>
