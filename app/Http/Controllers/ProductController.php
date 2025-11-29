<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return view('pages.admin.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.add_products');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

                // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'size' => 'nullable|string',
            'stock' => 'required|integer',
            'color' => 'nullable|string',
            'description' => 'required|string',
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Proses Upload Gambar
        $imagePath = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath[] = $image->store('products', 'public');
            }
        }

        // 3. Simpan ke Database
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

        // 4. Redirect kembali dengan pesan sukses
        return redirect()->route('admin')->with('success', 'Product created successfully!');


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
        $product = Product::findOrFail($id);

        // Kirim data produk ke view edit
        return view('pages.admin.edit_products', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Gunakan $product (tunggal) agar konsisten
        $product = Product::findOrFail($id);

        // 1. Validasi
        $request->validate([
            'name'         => 'required|string|max:255',
            'category'     => 'required|string',
            'price'        => 'required|numeric',
            'size'         => 'nullable|string',
            'stock'        => 'required|integer',
            'color'        => 'nullable|string',
            'description'  => 'required|string',
            'images.*'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // 2. Persiapkan data
        $data = [
            'name'        => $request->name,
            'category'    => $request->category,
            'price'       => $request->price,
            'size'        => $request->size,
            'stock'       => $request->stock,
            'color'       => $request->color,
            'description' => $request->description,
        ];

        // 3. Cek Upload Gambar Baru
        if ($request->hasFile('images')) {
            $imagePath = [];
            foreach ($request->file('images') as $image) {
                $imagePath[] = $image->store('products', 'public');
            }
            // Optional: Hapus gambar lama jika perlu (opsional)
            $data['images'] = $imagePath;
        }

        // 4. Update
        $product->update($data);

        return redirect()->route('admin')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $product = Product::findOrFail($id);

        // Hapus file gambar fisik
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
