<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit Profile - Rifold</title>
</head>
<body class="bg-[#FBF7F4]">

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Container Utama -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Tombol Back -->
        <div class="mb-6">
            <a href="javascript:history.back()" class="inline-flex items-center gap-2 text-gray-600 hover:text-black transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="font-medium">Back to Profile</span>
            </a>
        </div>

        <!-- Kartu Form -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="p-8">

                <!-- Header Form -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900">Edit Profile</h1>
                    <p class="mt-1 text-gray-600">Update your personal information below.</p>
                </div>

                <!-- Layout Dua Kolom -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

                    <!-- Kolom Kiri: Foto Profil -->
                    <div class="lg:col-span-1">
                        <h3 class="text-lg font-medium text-gray-800">Profile Photo</h3>
                        <div class="mt-4 flex flex-col items-center text-center">
                            <img src="/images/clean-outfit.png" alt="Current Profile Photo" class="w-40 h-40 rounded-full object-cover mb-4">
                            <label for="photo-upload" class="cursor-pointer w-full text-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors text-sm font-medium">
                                Upload a new photo
                            </label>
                            <input type="file" id="photo-upload" name="profile_photo" class="hidden">
                            <p class="text-xs text-gray-500 mt-2">PNG, JPG or GIF up to 5MB.</p>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Form Fields -->
                    <div class="lg:col-span-2">
                        {{-- Penting: Sesuaikan 'action' dengan route Anda --}}
                        <form action="#" method="POST" class="space-y-6">
                            @csrf
                            @method('PATCH') {{-- Gunakan PATCH atau PUT untuk update --}}

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <div>
                                    <label for="full_name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                    <input type="text" id="full_name" name="name" value="Felisitas Griselda"
                                           class="mt-1 block w-full bg-gray-50 border-transparent rounded-lg focus:border-gray-500 focus:bg-white focus:ring-0 transition">
                                </div>
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                    <input type="text" id="phone" name="phone" value="085859440829"
                                           class="mt-1 block w-full bg-gray-50 border-transparent rounded-lg focus:border-gray-500 focus:bg-white focus:ring-0 transition">
                                </div>
                            </div>

                            <div>
                                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                <textarea id="address" name="address" rows="3" class="mt-1 block w-full bg-gray-50 border-transparent rounded-lg focus:border-gray-500 focus:bg-white focus:ring-0 transition">Jl. Kebon Jeruk No. 12, Jakarta</textarea>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                <input type="email" id="email" name="email" value="grisel@email.com" disabled
                                       class="mt-1 block w-full bg-gray-200 text-gray-500 border-gray-200 rounded-lg cursor-not-allowed focus:ring-0">
                                <p class="text-xs text-gray-500 mt-1">Email address cannot be changed.</p>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Member Since</label>
                                <p class="mt-1 text-md text-gray-800">10 April 2023</p>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="pt-4 flex justify-end items-center gap-4">
                                <a href="#" class="text-sm font-medium text-gray-700 hover:text-black">Cancel</a>
                                <button type="submit" class="bg-black text-white px-6 py-2.5 rounded-lg font-semibold shadow-md hover:bg-gray-800 transition-colors">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('components.footer')

</body>
</html>
