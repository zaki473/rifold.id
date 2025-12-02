<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('pages.admin.products', compact('products'));
    }

    public function create()
    {
        return view('pages.admin.add_products');
    }

    public function store(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric', // Tidak perlu str_replace kalau input type="number"
            'size' => 'nullable|string',
            'stock' => 'required|integer',
            'color' => 'nullable|string',
            'description' => 'required|string',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048', // Sudah support webp
        ]);

        // 2. Upload Gambar
        $imagePath = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath[] = $image->store('products', 'public');
            }
        }

        // 3. Simpan
        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'size' => $request->size,
            'stock' => $request->stock,
            'color' => $request->color,
            'description' => $request->description,
            'images' => $imagePath,
        ]);

        return redirect()->route('admin')->with('success', 'Product created successfully!');
    }

    // --- FRONTEND ---
    public function katalog()
    {
        $products = Product::latest()->get();
        return view('pages.katalog.katalog', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('pages.katalog.detail', compact('product'));
    }

    // --- EDIT & DELETE ---
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        return view('pages.admin.edit_products', compact('product'));
    }

    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'         => 'required|string|max:255',
            'category'     => 'required|string',
            'price'        => 'required|numeric',
            'size'         => 'nullable|string',
            'stock'        => 'required|integer',
            'color'        => 'nullable|string',
            'description'  => 'required|string',
            'images.*'     => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'price', 'size', 'stock', 'color', 'description']);

        if ($request->hasFile('images')) {
            $imagePath = [];
            foreach ($request->file('images') as $image) {
                $imagePath[] = $image->store('products', 'public');
            }
            // Opsional: Hapus gambar lama di sini jika mau
            $data['images'] = $imagePath;
        }

        $product->update($data);

        return redirect()->route('admin')->with('success', 'Product updated successfully!');
    }

    public function destroy(string $id)
    {
       $product = Product::findOrFail($id);
        if ($product->images && is_array($product->images)) {
            foreach ($product->images as $image) {
                if(Storage::disk('public')->exists($image)){
                    Storage::disk('public')->delete($image);
                }
            }
        }
        $product->delete();
        return redirect()->route('admin')->with('success', 'Product deleted successfully!');
    }
}