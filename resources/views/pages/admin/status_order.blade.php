<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Management | Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Tailwind --}}
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <style>
        .status-select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.5rem center;
            background-repeat: no-repeat;
            background-size: 1.25em 1.25em;
            padding-right: 2.5rem;
        }
    </style>
</head>

<body class="flex bg-gray-100">

@include('components.sidebar')

<main class="flex-1 ml-64">

    @include('components.header_admin')

    <div class="p-8">

        <h2 class="text-2xl font-semibold mb-6 text-gray-800">
            Order Management
        </h2>

        <div class="bg-white rounded-lg shadow p-6">

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">

                    <thead>
                        <tr class="border-b bg-gray-50 text-gray-600 uppercase text-xs tracking-wider">
                            <th class="p-4">Order ID</th>
                            <th class="p-4">Customer</th>
                            <th class="p-4">Date</th>
                            <th class="p-4">Total</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-sm text-gray-700">

                        @forelse ($orders as $order)
                        <tr class="border-b hover:bg-gray-50 transition">

                            {{-- ORDER NUMBER --}}
                            <td class="p-4 font-semibold text-blue-600">
                                #{{ $order->order_number }}
                            </td>

                            {{-- CUSTOMER --}}
                            <td class="p-4">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center font-bold mr-3">
                                        {{ strtoupper(substr($order->customer_name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold">{{ $order->customer_name }}</p>
                                        <p class="text-xs text-gray-500">{{ $order->email }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- DATE --}}
                            <td class="p-4">
                                {{ $order->created_at->format('d M Y') }}
                            </td>

                            {{-- TOTAL --}}
                            <td class="p-4 font-bold">
                                Rp {{ number_format($order->total_price, 0, ',', '.') }}
                            </td>

                            {{-- STATUS DROPDOWN --}}
                            <td class="p-4">
                                <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <select name="status"
                                        onchange="this.form.submit()"
                                        class="status-select border border-gray-300 rounded-full px-3 py-1 text-xs font-semibold
                                        @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($order->status == 'paid') bg-blue-100 text-blue-800
                                        @elseif($order->status == 'processed') bg-purple-100 text-purple-800
                                        @elseif($order->status == 'shipped') bg-indigo-100 text-indigo-800
                                        @elseif($order->status == 'delivered') bg-green-100 text-green-800
                                        @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                                        @endif">

                                        <option value="pending"   {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="paid"      {{ $order->status == 'paid' ? 'selected' : '' }}>Paid</option>
                                        <option value="processed"{{ $order->status == 'processed' ? 'selected' : '' }}>Processed</option>
                                        <option value="shipped"   {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                        <option value="delivered"{{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                        <option value="cancelled"{{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>

                            {{-- VIEW DETAIL --}}
                            <td class="p-4">
                                <a href="{{ route('orders.show', $order->id) }}"
                                   class="text-blue-600 hover:underline font-medium text-sm">
                                    View Detail
                                </a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-6 text-center text-gray-500">
                                Belum ada data order.
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="mt-6">
                {{ $orders->links() }}
            </div>

        </div>
    </div>

</main>

</body>
</html>
