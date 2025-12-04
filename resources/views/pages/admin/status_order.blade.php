<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rifold Dashboard Admin - Order Status</title>

    {{-- Tailwind CSS --}}
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f7f6;
        }
        /* Style tambahan untuk status badge agar dropdown terlihat rapi */
        select.status-select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }
    </style>
</head>

<body class="flex bg-gray-100">

    {{-- Memanggil Sidebar Anda --}}
    @include('components.sidebar')

    {{-- Main Content --}}
    <main class="flex-1 ml-64">

        {{-- Memanggil Header Admin Anda --}}
        @include('components.header_admin')

        <div class="p-8">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Order Management</h2>

            <div class="bg-white rounded-lg shadow p-6">

                {{-- Header Tabel & Search --}}
                <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold mb-4 md:mb-0">Customer Orders</h3>

                    <div class="flex space-x-2 w-full md:w-auto">
                        {{-- Filter Status Statis --}}
                        <select class="border border-gray-300 rounded-md p-2 text-sm bg-gray-50 focus:outline-none focus:border-blue-500">
                            <option>Filter Status</option>
                            <option>Pending</option>
                            <option>Shipped</option>
                            <option>Completed</option>
                        </select>

                        {{-- Search Input Statis --}}
                        <input type="text" placeholder="Search Order ID..."
                            class="p-2 border border-gray-300 rounded-md text-sm w-full md:w-64 focus:outline-none focus:border-blue-500">
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
                                <th class="p-4 font-semibold">Order ID</th>
                                <th class="p-4 font-semibold">Customer</th>
                                <th class="p-4 font-semibold">Date</th>
                                <th class="p-4 font-semibold">Total</th>
                                <th class="p-4 font-semibold">Status</th>
                                <th class="p-4 font-semibold">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700">

                            {{-- CONTOH DATA 1: Status Pending --}}
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="p-4 font-medium text-blue-600">#ORD-00231</td>
                                <td class="p-4">
                                    <div class="flex items-center">
                                        {{-- Avatar Placeholder --}}
                                        <div class="h-8 w-8 rounded-full bg-blue-200 flex items-center justify-center text-blue-700 font-bold mr-3">
                                            JD
                                        </div>
                                        <div>
                                            <p class="font-semibold">John Doe</p>
                                            <p class="text-xs text-gray-500">john@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">12 Oct 2023</td>
                                <td class="p-4 font-bold">Rp 150.000</td>
                                <td class="p-4">
                                    {{-- Dropdown Status (Kuning untuk Pending) --}}
                                    <select class="status-select bg-yellow-100 text-yellow-800 border border-yellow-200 rounded-full px-3 py-1 text-xs font-semibold cursor-pointer focus:outline-none">
                                        <option selected>Pending</option>
                                        <option>Processing</option>
                                        <option>Shipped</option>
                                        <option>Completed</option>
                                    </select>
                                </td>
                                <td class="p-4">
                                    <a href="#" class="text-blue-500 hover:text-blue-700 font-medium text-sm">View Detail</a>
                                </td>
                            </tr>

                            {{-- CONTOH DATA 2: Status Processing --}}
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="p-4 font-medium text-blue-600">#ORD-00232</td>
                                <td class="p-4">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-green-200 flex items-center justify-center text-green-700 font-bold mr-3">
                                            AS
                                        </div>
                                        <div>
                                            <p class="font-semibold">Ahmad Supri</p>
                                            <p class="text-xs text-gray-500">ahmad@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">11 Oct 2023</td>
                                <td class="p-4 font-bold">Rp 450.000</td>
                                <td class="p-4">
                                    {{-- Dropdown Status (Biru untuk Processing) --}}
                                    <select class="status-select bg-blue-100 text-blue-800 border border-blue-200 rounded-full px-3 py-1 text-xs font-semibold cursor-pointer focus:outline-none">
                                        <option>Pending</option>
                                        <option selected>Processing</option>
                                        <option>Shipped</option>
                                        <option>Completed</option>
                                    </select>
                                </td>
                                <td class="p-4">
                                    <a href="#" class="text-blue-500 hover:text-blue-700 font-medium text-sm">View Detail</a>
                                </td>
                            </tr>

                            {{-- CONTOH DATA 3: Status Shipped --}}
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="p-4 font-medium text-blue-600">#ORD-00230</td>
                                <td class="p-4">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-purple-200 flex items-center justify-center text-purple-700 font-bold mr-3">
                                            LS
                                        </div>
                                        <div>
                                            <p class="font-semibold">Lisa Sugiarto</p>
                                            <p class="text-xs text-gray-500">lisa@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">10 Oct 2023</td>
                                <td class="p-4 font-bold">Rp 1.200.000</td>
                                <td class="p-4">
                                    {{-- Dropdown Status (Ungu untuk Shipped) --}}
                                    <select class="status-select bg-purple-100 text-purple-800 border border-purple-200 rounded-full px-3 py-1 text-xs font-semibold cursor-pointer focus:outline-none">
                                        <option>Pending</option>
                                        <option>Processing</option>
                                        <option selected>Shipped</option>
                                        <option>Completed</option>
                                    </select>
                                </td>
                                <td class="p-4">
                                    <a href="#" class="text-blue-500 hover:text-blue-700 font-medium text-sm">View Detail</a>
                                </td>
                            </tr>

                            {{-- CONTOH DATA 4: Status Completed --}}
                            <tr class="border-b hover:bg-gray-50 transition">
                                <td class="p-4 font-medium text-blue-600">#ORD-00229</td>
                                <td class="p-4">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold mr-3">
                                            BW
                                        </div>
                                        <div>
                                            <p class="font-semibold">Budi Wibowo</p>
                                            <p class="text-xs text-gray-500">budi@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">09 Oct 2023</td>
                                <td class="p-4 font-bold">Rp 75.000</td>
                                <td class="p-4">
                                    {{-- Dropdown Status (Hijau untuk Completed) --}}
                                    <select class="status-select bg-green-100 text-green-800 border border-green-200 rounded-full px-3 py-1 text-xs font-semibold cursor-pointer focus:outline-none">
                                        <option>Pending</option>
                                        <option>Processing</option>
                                        <option>Shipped</option>
                                        <option selected>Completed</option>
                                    </select>
                                </td>
                                <td class="p-4">
                                    <a href="#" class="text-blue-500 hover:text-blue-700 font-medium text-sm">View Detail</a>
                                </td>
                            </tr>

                             {{-- CONTOH DATA 5: Status Cancelled --}}
                             <tr class="border-b hover:bg-gray-50 transition">
                                <td class="p-4 font-medium text-blue-600">#ORD-00228</td>
                                <td class="p-4">
                                    <div class="flex items-center">
                                        <div class="h-8 w-8 rounded-full bg-red-200 flex items-center justify-center text-red-700 font-bold mr-3">
                                            RM
                                        </div>
                                        <div>
                                            <p class="font-semibold">Rina Melati</p>
                                            <p class="text-xs text-gray-500">rina@example.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">08 Oct 2023</td>
                                <td class="p-4 font-bold">Rp 200.000</td>
                                <td class="p-4">
                                    {{-- Dropdown Status (Merah untuk Cancelled) --}}
                                    <select class="status-select bg-red-100 text-red-800 border border-red-200 rounded-full px-3 py-1 text-xs font-semibold cursor-pointer focus:outline-none">
                                        <option>Pending</option>
                                        <option>Processing</option>
                                        <option>Shipped</option>
                                        <option>Completed</option>
                                        <option selected>Cancelled</option>
                                    </select>
                                </td>
                                <td class="p-4">
                                    <a href="#" class="text-blue-500 hover:text-blue-700 font-medium text-sm">View Detail</a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                {{-- Pagination Statis --}}
                <div class="mt-6 flex justify-between items-center text-sm text-gray-600">
                    <div>
                        Showing 1 to 5 of 50 entries
                    </div>
                    <div class="flex space-x-1">
                        <button class="px-3 py-1 border rounded-md hover:bg-gray-100 disabled:opacity-50" disabled>&lt;</button>
                        <button class="px-3 py-1 border rounded-md bg-blue-500 text-white">1</button>
                        <button class="px-3 py-1 border rounded-md hover:bg-gray-100">2</button>
                        <button class="px-3 py-1 border rounded-md hover:bg-gray-100">3</button>
                        <span class="px-2 py-1">...</span>
                        <button class="px-3 py-1 border rounded-md hover:bg-gray-100">10</button>
                        <button class="px-3 py-1 border rounded-md hover:bg-gray-100">&gt;</button>
                    </div>
                </div>

            </div>
        </div>
    </main>

</body>

</html>
