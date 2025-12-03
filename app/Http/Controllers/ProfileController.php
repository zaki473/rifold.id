<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Halaman profil
    public function index()
    {
        return view('pages.profile.profile', [
            'user' => Auth::user()
        ]);
    }

    // Halaman edit profil
    public function edit()
    {
        return view('pages.profile.edit', [
            'user' => Auth::user()
        ]);
    }

    // Update profil
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Update nama dan email
        $user->name = $request->name;
        $user->email = $request->email;

        // Jika upload foto baru
        if ($request->hasFile('profile_photo')) {

            // Hapus foto lama kalau ada
            if ($user->profile_photo_path && file_exists(storage_path('app/public/' . $user->profile_photo_path))) {
                unlink(storage_path('app/public/' . $user->profile_photo_path));
            }

            // Upload foto baru
            $path = $request->file('profile_photo')->store('profile', 'public');

            // Simpan path ke database
            $user->profile_photo_path = $path;
        }

        // Simpan perubahan
        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profile updated!');
    }
}
