<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User; // Pastikan Model User di-import
use App\Models\Order;

class ProfileController extends Controller
{
    // Menampilkan Halaman Profil
    public function index()
{
    $user = Auth::user();

    $orders = Order::with(['items.product' => function ($query) {
        $query->withTrashed(); // penting! biar product yang soft-deleted tetap muncul
    }])
    ->where('user_id', $user->id)
    ->orderBy('created_at', 'desc')
    ->get();

    foreach ($orders as $order) {
        // Cari item yang product-nya masih ada (atau pernah ada)
        $firstItemWithProduct = $order->items->firstWhere('product', '!=', null);

        $order->firstItem = $firstItemWithProduct ?? $order->items->first();
    }

    return view('pages.profile.profile', compact('user', 'orders'));
}


    // Menampilkan Halaman Edit
    public function edit()
    {
        $user = Auth::user();
        return view('pages.profile.edit', compact('user'));
    }

    // Proses Update Data & Foto
    public function update(Request $request)
    {
        $user = Auth::user();

        // 1. Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Max 2MB
        ]);

        // 2. Update Info Dasar
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;

        // 3. Cek apakah ada upload foto
        if ($request->hasFile('profile_photo')) {

            // Hapus foto lama jika ada (dan bukan default/dummy)
            if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Simpan foto baru ke folder 'profile-photos' di storage public
            // Hasilnya misal: profile-photos/unik123.jpg
            $path = $request->file('profile_photo')->store('profile-photos', 'public');

            // Simpan path ke database
            $user->profile_photo_path = $path;
        }

        /** @var \App\Models\User $user */
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui!');
    }
}
