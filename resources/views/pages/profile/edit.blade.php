<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>Edit Profile - Rifold</title>
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-white text-gray-900 antialiased">

    @include('components.navbar')

    <div class="max-w-6xl mx-auto px-6 md:px-12 pt-32 pb-24">

        <div class="flex flex-col md:flex-row md:items-center justify-between border-b border-gray-100 pb-8 mb-12">
            <div>
                <h1 class="text-3xl md:text-4xl font-light tracking-tight text-gray-900">
                    Edit <span class="font-bold">Profile</span>
                </h1>
                <p class="text-gray-500 mt-2 text-sm md:text-base">Perbarui data diri dan foto profile Anda.</p>
            </div>

            <a href="javascript:history.back()" 
               class="mt-4 md:mt-0 inline-flex items-center text-sm font-bold uppercase tracking-widest text-gray-400 hover:text-black transition-colors group">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6">
                <strong class="font-bold">Ups! Ada masalah.</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start">

                <!-- LEFT SIDE: PHOTO EDIT -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="relative group w-full aspect-[3/4] bg-gray-100 rounded-2xl overflow-hidden shadow-sm">

                        @if($user->profile_photo_path)
                            <img id="preview-image"
                                 src="{{ asset('storage/' . $user->profile_photo_path) }}"
                                 alt="{{ $user->name }}"
                                 class="w-full h-full object-cover object-top transition duration-500 group-hover:scale-105">
                        @else
                            <img id="preview-image"
                                 src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=500"
                                 alt="Default Avatar"
                                 class="w-full h-full object-cover object-top transition duration-500 group-hover:scale-105">
                        @endif

                        <!-- FIXED: name="profile_photo" -->
                        <label for="photo-upload" 
                               class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center cursor-pointer">
                            <div class="bg-white px-5 py-3 rounded-full shadow-lg flex items-center gap-2 transform translate-y-4 group-hover:translate-y-0 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="text-xs font-bold uppercase tracking-widest text-black">Upload New</span>
                            </div>
                        </label>

                        <input type="file" id="photo-upload" 
                               name="profile_photo" 
                               class="hidden" 
                               onchange="previewFile()">

                    </div>

                    <p class="text-center text-xs text-gray-400 font-medium">
                        Allowed: JPG, PNG. Max 2MB.<br>
                        Recommended ratio 3:4 or 4:5.
                    </p>
                </div>

                <!-- RIGHT SIDE FORM -->
                <div class="lg:col-span-8 space-y-8">

                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            <div class="group">
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.15em] mb-2">
                                    Full Name
                                </label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                       class="w-full bg-gray-50 border-0 rounded-lg px-4 py-3 text-gray-900 font-medium 
                                       focus:ring-2 focus:ring-black focus:bg-white transition">
                            </div>

                            <div class="group">
                                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.15em] mb-2">
                                    Phone Number
                                </label>
                                <input type="text" name="phone" value="{{ old('phone', $user->phone ?? '') }}"
                                       class="w-full bg-gray-50 border-0 rounded-lg px-4 py-3">
                            </div>
                        </div>

                        <div class="group opacity-75">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.15em] mb-2">
                                Email Address
                            </label>

                            <input type="hidden" name="email" value="{{ $user->email }}">

                            <input type="email" value="{{ $user->email }}" disabled
                                   class="w-full bg-gray-100 border-0 rounded-lg px-4 py-3 text-gray-500">
                        </div>

                        <div class="group">
                            <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.15em] mb-2">
                                Shipping Address
                            </label>
                            <textarea name="address" rows="4"
                                      class="w-full bg-gray-50 border-0 rounded-lg px-4 py-3">{{ old('address', $user->address ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="pt-8 border-t border-gray-100 flex items-center justify-end gap-6">
                        <a href="{{ route('home') }}" class="text-sm font-semibold text-gray-500 hover:text-black">
                            Cancel
                        </a>
                        <button type="submit"
                                class="bg-black text-white px-8 py-3 rounded-lg font-bold text-sm uppercase tracking-wider shadow-lg">
                            Save Changes
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>

    @include('components.footer')

    <script>
        function previewFile() {
            const preview = document.getElementById('preview-image');
            const file = document.querySelector('input[type=file]').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                preview.src = reader.result;
            });

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
