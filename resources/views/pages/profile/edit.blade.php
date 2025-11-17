<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Edit Profil - Rifold</title>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Container Edit Profil -->
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-center text-2xl font-semibold mb-6">Edit Profil</h2>

        <!-- Foto Profil -->
        <div class="flex flex-col items-center mb-6">
            <img src="/images/clean-outfit.png" alt="Profile Photo"
                class="w-32 h-32 rounded-full object-cover border-2 border-gray-300">
                <button class="mt-3 px-4 py-1 rounded-md bg-black hover:bg-gray-900 text-white">
    Ganti Foto
</button>

        </div>

        <!-- Form Edit Profil -->
        <form action="#" method="POST" class="space-y-4">

            <!-- Full Name -->
            <div>
                <label class="block mb-1 text-sm font-medium">Full Name</label>
                <input type="text" value="John Doe"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <!-- Phone -->
            <div>
                <label class="block mb-1 text-sm font-medium">Phone</label>
                <input type="text" value="+62 812 3456 7890"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <!-- Address -->
            <div>
                <label class="block mb-1 text-sm font-medium">Address</label>
                <textarea class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">Jl. Kebon Jeruk No. 12, Jakarta</textarea>
            </div>

            <!-- Email -->
            <div>
                <label class="block mb-1 text-sm font-medium">Email</label>
                <input type="email" value="johndoe@example.com"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <!-- Join Date -->
            <div>
                <label class="block mb-1 text-sm font-medium">Join Date</label>
                <input type="date" value="2023-04-10"
                    class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <button type="submit"
    class="w-full bg-black hover:bg-gray-900 text-white px-4 py-2 rounded-md font-medium">
    Simpan Perubahan
</button>

        </form>
    </div>

    <!-- Footer -->
    @include('components.footer')

</body>

</html>
