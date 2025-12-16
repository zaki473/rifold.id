<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContentImage; // Gunakan model yang benar
use Illuminate\Support\Facades\Storage;

class ImagesController extends Controller
{
    public function index()
    {
        $images = ContentImage::latest()->paginate(10);
        return view('pages.admin.images_list', compact('images'));
    }

    public function create()
    {
        return view('pages.admin.add_images');
    }

    public function store(Request $request)
    {
        $request->validate([
            'images_name' => 'required|string|max:255',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:2048', // Single file
        ]);

        if ($request->hasFile('image')) {
            // Upload file
            $path = $request->file('image')->store('content_images', 'public');

            // Simpan ke DB
            ContentImage::create([
                'name'       => $request->images_name,
                'image_path' => $path,
            ]);
        }

        return redirect()->route('images.index')->with('success', 'Image uploaded successfully!');
    }

    public function destroy($id)
    {
        $image = ContentImage::findOrFail($id);
        
        // Hapus file fisik
        if (Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();
        return redirect()->route('images.index')->with('success', 'Image deleted successfully.');
    }
}