<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Images List - Rifold Admin</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex bg-gray-100">

    @include('components.sidebar')

    <main class="flex-1 ml-64">
        @include('components.header_admin')
        
        <div class="p-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Content Images (Home Banner)</h2>
                <a href="{{ route('images.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition">
                    + Add New Image
                </a>
            </div>

            {{-- Pesan Sukses --}}
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
                        <tr>
                            <th class="p-4 border-b">Preview</th>
                            <th class="p-4 border-b">Name</th>
                            <th class="p-4 border-b">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($images as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4">
                                    {{-- Tampilkan Gambar --}}
                                    <div class="w-32 h-20 rounded-lg overflow-hidden border border-gray-200">
                                        <img src="{{ asset('storage/' . $item->image_path) }}" 
                                             alt="{{ $item->name }}" 
                                             class="w-full h-full object-cover">
                                    </div>
                                </td>
                                <td class="p-4 font-medium text-gray-900">
                                    {{ $item->name }}
                                </td>
                                <td class="p-4">
                                    <form action="{{ route('images.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus gambar ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="p-8 text-center text-gray-500">
                                    Belum ada gambar yang diupload.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="p-4 border-t border-gray-100">
                    {{ $images->links() }}
                </div>
            </div>
        </div>
    </main>

</body>
</html>