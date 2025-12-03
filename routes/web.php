<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MixAndMatchController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;

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

Route::get('/katalog/detail', function () {
    return view('pages.katalog.detail');
})->name('produk.detail');

Route::get(
    '/katalog',
    [ProductController::class, 'katalog']
)
    ->name('katalog');

Route::get('/katalog/{id}', [ProductController::class, 'show'])
    ->name('detail');


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
})->name('mixandmatch.view_detail'); // Ganti nama dikit biar ga duplikat

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

    // Dashboard
    Route::get('/', [ProductController::class, 'index'])->name('admin');

    // Products Management
    Route::get('/products_list', [ProductController::class, 'index'])->name('products.index');
    Route::get('/add_products', [ProductController::class, 'create'])->name('add_products');
    Route::post('/store_products', [ProductController::class, 'store'])->name('store_products');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('edit_products');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Mix and Match Management
    Route::get('/list', [MixAndMatchController::class, 'index'])->name('mixandmatch.index');
    Route::get('/add_mixandmatch', [MixAndMatchController::class, 'create'])->name('mixandmatch.create');
    Route::post('/store_mixandmatch', [MixAndMatchController::class, 'store'])->name('mixandmatch.store');
    Route::get('/mixandmatch/{mixAndMatch}/edit', [MixAndMatchController::class, 'edit'])->name('mixandmatch.edit');
    Route::put('/mixandmatch/{mixAndMatch}', [MixAndMatchController::class, 'update'])->name('mixandmatch.update');
    Route::delete('/mixandmatch/{mixAndMatch}', [MixAndMatchController::class, 'destroy'])->name('mixandmatch.destroy');

    // Images Management
    Route::get('/images_list', [ImagesController::class, 'index'])->name('images.index');
    Route::get('/add_images', [ImagesController::class, 'create'])->name('images.create');
    Route::post('/store_images', [ImagesController::class, 'store'])->name('images.store');
    Route::get('/images/{images}/edit', [ImagesController::class, 'edit'])->name('images.edit');
    Route::put('/images/{images}', [ImagesController::class, 'update'])->name('images.update');
    Route::delete('/images/{images}', [ImagesController::class, 'destroy'])->name('images.destroy');
});


Route::get('/payment_qris', function () {
    return view('pages.checkout.payment_qris');
})->name('payment_qris');

Route::get('/payment_bank', function () {
    return view('pages.checkout.payment_bank');
})->name('payment_bank');
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

Route::post('/reviews/store', [ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('reviews.store');

    Route::get('/katalog/{id}/review', [ReviewController::class, 'create'])
    ->middleware('auth') // Wajib login
    ->name('reviews.create');

// Route untuk MENYIMPAN data review (Action form)
Route::post('/reviews/store', [ReviewController::class, 'store'])
    ->middleware('auth')
    ->name('reviews.store');

    Route::middleware('auth')->group(function () {
    // Menampilkan Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    
    // Tambah ke Cart (Dari Detail Page)
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
    
    // Update Quantity (+/-)
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    
    // Hapus Item
    Route::delete('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    
    // Profile (yang lama biarkan)
    Route::get('/profile', function () { return view('pages.profile.profile'); })->name('profile');
});