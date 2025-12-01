<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\images;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $imagePaths = images::latest()->paginate(10);

    return view('pages.admin.images', compact('imagePaths'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.add_images');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'images_name' => 'required|string|max:255',
            'images'      => 'required',
            'images.*'    => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('images_thumbnail', 'public');
            }
        }

        images::create([
            'name'        => $request->images_name,
            'images_path' => json_encode($imagePaths),
        ]);


        return redirect()->route('images.index')->with('success', 'Images added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $imagePaths = images::findOrFail($id);

        return view('pages.admin.edit_images', compact('imagePaths'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'images_name' => 'required|string|max:255',
            'images.*'    => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePaths = images::findOrFail($id);

        $newImagePaths = json_decode($imagePaths->images_path, true) ?? [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $newImagePaths[] = $image->store('images_thumbnail', 'public');
            }
        }

        $imagePaths->update([
            'name'        => $request->images_name,
            'images_path' => json_encode($newImagePaths),
        ]);

        return redirect()->route('images.index')->with('success', 'Images updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $imagePaths = images::findOrFail($id);
        $imagePaths->delete();

        return redirect()->route('images.index')->with('success', 'Images deleted successfully.');
    }
}
