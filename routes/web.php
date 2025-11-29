<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\RoleMiddleware;

Route::get('/', function () {
    return view('pages.home.home');
})->name('home');

Route::get('/about', function () {
    return view('pages.about.about');
})->name('about');

Route::get('/bestseller', function () {
    return view('pages.home.bestseller');
})->name('bestseller');

Route::get('/katalog', function () {
    return view('pages.katalog.katalog');
})->name('katalog');

Route::get('/katalog/{id}', function ($id) {
    return view('pages.katalog.detail', ['id' => $id]);
})->name('detail');

Route::get('/mixandmatch', function () {
    return view('pages.mixandmatch.mixandmatch');
})->name('mixandmatch');

Route::get('/mixandmatch/{id}', function ($id) {
    return view('pages.mixandmatch.detail', ['id' => $id]);
})->name('mixandmatch.detail');


Route::get('/checkout', function () {
    return view('pages.checkout.checkout');
})->name('checkout');

Route::post('/checkout/shipping', function () {
    return view('pages.checkout.shipping');
})->name('checkout.shipping');

Route::post('/checkout/payment', function () {
    return view('pages.checkout.payment');
})->name('checkout.payment');

Route::post('/checkout/confirmation', function () {
    return view('pages.checkout.confirmation');
})->name('checkout.confirmation');

// Admin routes (protected)
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('pages.admin.products');
    })->name('admin');

    Route::get('/add_products', function () {
        return view('pages.admin.add_products');
    })->name('add_products');

    Route::get('/add_images', function () {
        return view('pages.admin.add_images');
    })->name('add_images');

    Route::get('/add_mixandmatch', function () {
        return view('pages.admin.add_mixandmatch');
    })->name('add_mixandmatch');

    Route::get('/add_video', function () {
        return view('pages.admin.add_video');
    })->name('add_video');

    Route::get('/video', function () {
        return view('pages.admin.video');
    })->name('admin.video');

    Route::get('/images', function () {
        return view('pages.admin.images');
    })->name('admin.images');
});

// login dan register
Route::get('/login', [AuthController::class, 'loginPage'])->name('loginpage');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'registerPage'])->name('registerpage');
Route::post('/register', [AuthController::class, 'register'])->name('register');
// end login dan register

// cart dan profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
    return view('pages.profile.profile');
    })->name('profile');

    Route::get('/cart', function () {
    return view('pages.checkout.cart');
    })->name('cart');
});


Route::get('/profile/edit', function () {
    return view('pages.profile.edit');
})->name('profile.edit');



// (admin video/images routes are registered above within the protected admin group)

Route::get('/katalog/detail', function () {
    return view('pages.katalog.detail');
})->name('produk.detail');

Route::get('/mixandmatch/detail', function () {
    return view('pages.mixandmatch.detail');
})->name('mixandmatch.detail');

// 1. Route untuk Menampilkan Form Review (GET)
// Mengarah ke file: resources/views/pages/katalog/detail.review.blade.php
Route::get('/katalog/{id}/review', function ($id) {
    // File ada di: resources/views/pages/katalog/detail.review.blade.php
    // Karena nama file mengandung titik, gunakan view()->file() dengan path penuh
    return view()->file(resource_path('views/pages/katalog/detail.review.blade.php'), ['id' => $id]);
})->name('reviews.create');

// 2. Route untuk Memproses Simpan Review (POST)
Route::post('/reviews/store', function (Request $request) {
    // Karena belum ada database, kita pura-pura simpan dan redirect balik
    // Ambil ID produk dari input hidden, kalau tidak ada default ke 1
    $id = $request->input('product_id', 1);

    // Redirect kembali ke halaman detail produk
    return redirect()->route('detail', ['id' => $id]);
})->name('reviews.store');

//logout
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
