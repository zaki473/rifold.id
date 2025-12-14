<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\MixAndMatch;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('pages.admin.products', compact('products'));
    }

   public function create()
{
    $mixAndMatches = MixAndMatch::all();
    return view('pages.admin.add_products', compact('mixAndMatches'));
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
            'mix_and_match_id' => 'nullable|exists:mix_and_matches,id',
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
            'mix_and_match_id' => $request->mix_and_match_id,
        ]);

        return redirect()->route('admin')->with('success', 'Product created successfully!');
    }

    // --- FRONTEND ---
    public function katalog(Request $request)
    {
        // 1. Mulai Query Dasar
        $query = Product::latest();

        // 2. Jika ada search, filter datanya
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            
            $query->where(function($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                  ->orWhere('category', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // 3. Ambil hasil akhirnya
        $products = $query->get();

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
        $mixAndMatches = MixAndMatch::all();
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
            'mix_and_match_id' => 'nullable|exists:mix_and_matches,id',

        ]);

        $data = $request->only(['name', 'category', 'price', 'size', 'stock', 'color', 'description','mix_and_match_id']);

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
