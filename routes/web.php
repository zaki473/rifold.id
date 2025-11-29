<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MixAndMatchController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('pages.home.home');
})->name('home');

Route::get('/about', function () {
    return view('pages.about.about');
})->name('about');

Route::get('/bestseller', function () {
    return view('pages.home.bestseller');
})->name('bestseller');

/*
|--------------------------------------------------------------------------
| Katalog
|--------------------------------------------------------------------------
*/

Route::get('/katalog', function () {
    return view('pages.katalog.katalog');
})->name('katalog');

Route::get('/katalog/{id}', function ($id) {
    return view('pages.katalog.detail', ['id' => $id]);
})->name('detail');

Route::get('/katalog/detail', function () {
    return view('pages.katalog.detail');
})->name('produk.detail');

/*
|--------------------------------------------------------------------------
| Mix & Match
|--------------------------------------------------------------------------
*/

Route::get('/mixandmatch', function () {
    return view('pages.mixandmatch.mixandmatch');
})->name('mixandmatch');

Route::get('/mixandmatch/{id}', function ($id) {
    return view('pages.mixandmatch.detail', ['id' => $id]);
})->name('mixandmatch.detail');

Route::get('/mixandmatch/detail', function () {
    return view('pages.mixandmatch.detail');
})->name('mixandmatch.detail');

/*
|--------------------------------------------------------------------------
| Checkout
|--------------------------------------------------------------------------
*/

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

/*
|--------------------------------------------------------------------------
| Auth (Login & Register)
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'loginPage'])->name('loginpage');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'registerPage'])->name('registerpage');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| User Protected Routes (auth)
|--------------------------------------------------------------------------
*/

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

/*
|--------------------------------------------------------------------------
| Admin (auth)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('admin')->group(function () {

    // Products
    Route::get('/', [ProductController::class, 'index'])->name('admin');

    Route::get('/add_products', [ProductController::class, 'create'])->name('add_products');
    Route::post('/store_products', [ProductController::class, 'store'])->name('store_products');

    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('edit_products');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Admin pages
    Route::get('/add_images', function () {
        return view('pages.admin.add_images');
    })->name('add_images');

    Route::resource('mix-and-match', MixAndMatchController::class);
    Route::get('/add_mixandmatch', function () {
        return view('pages.admin.add_mixandmatch');
    })->name('add_mixandmatch');

    Route::get('/mixandmatch', function () {
        return view('pages.admin.mixandmatch');
    })->name('admin.mixandmatch');

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

/*
|--------------------------------------------------------------------------
| Review
|--------------------------------------------------------------------------
*/

// Form review
Route::get('/katalog/{id}/review', function ($id) {
    return view()->file(
        resource_path('views/pages/katalog/detail.review.blade.php'),
        ['id' => $id]
    );
})->name('reviews.create');

// Simpan review (dummy)
Route::post('/reviews/store', function (Request $request) {
    $id = $request->input('product_id', 1);
    return redirect()->route('detail', ['id' => $id]);
})->name('reviews.store');
