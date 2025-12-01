<?php

namespace App\Http\Controllers;

use App\Models\MixAndMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MixAndMatchController extends Controller
{
    public function index()
    {
        $mixAndMatches = MixAndMatch::latest()->paginate(10);
        return view('pages.admin.mixandmatch_list', compact('mixAndMatches'));
    }

    public function create()
    {
        return view('pages.admin.add_mixandmatch');
    }

    public function store(Request $request)
    {
        $request->validate([
            'images_name' => 'required|string|max:255',
            'images'      => 'required',
            'images.*'    => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('mixandmatch', 'public');
            }
        }

        MixAndMatch::create([
            'name'        => $request->images_name,
            'images_path' => json_encode($imagePaths),
        ]);

        // Perbaikan: Redirect ke route yang benar 'mixandmatch.index'
        return redirect()->route('mixandmatch.index')->with('success', 'Mix & Match created successfully.');
    }

    public function show(MixAndMatch $mixAndMatch)
    {
        // Biasanya tidak dipakai di admin panel sederhana
    }

    public function edit(MixAndMatch $mixAndMatch)
    {
        return view('pages.admin.edit_mixandmatch', compact('mixAndMatch'));
    }

    public function update(Request $request, MixAndMatch $mixAndMatch)
    {
        // Tidak perlu findOrFail lagi karena $mixAndMatch sudah terisi otomatis

        $request->validate([
            'images_name' => 'required|string|max:255',
            'images.*'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $mixAndMatch->name = $request->images_name;

        if ($request->hasFile('images')) {
            // 1. Hapus gambar lama fisik
            $oldImages = json_decode($mixAndMatch->images_path);
            if ($oldImages) {
                foreach ($oldImages as $oldImage) {
                    if (Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
            }

            // 2. Upload gambar baru
            $newImagePaths = [];
            foreach ($request->file('images') as $image) {
                $newImagePaths[] = $image->store('mixandmatch', 'public');
            }

            $mixAndMatch->images_path = json_encode($newImagePaths);
        }

        $mixAndMatch->save();

        return redirect()->route('mixandmatch.index')->with('success', 'Data updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MixAndMatch $mixAndMatch)
    {
        // 1. Hapus file gambar dari storage
        $images = json_decode($mixAndMatch->images_path);
        if ($images) {
            foreach ($images as $image) {
                if (Storage::disk('public')->exists($image)) {
                    Storage::disk('public')->delete($image);
                }
            }
        }

        // 2. Hapus data dari database
        $mixAndMatch->delete();

        return redirect()->route('mixandmatch.index')->with('success', 'Mix & Match deleted successfully.');
    }
}
