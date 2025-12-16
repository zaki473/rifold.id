<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MixAndMatchController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController; 
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\HomeController;
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

Route::get('/katalog', [ProductController::class, 'katalog'])->name('katalog');
Route::get('/katalog/{product:nama}', [ProductController::class, 'show'])->name('detail');


/*
|--------------------------------------------------------------------------
| Mix & Match
|--------------------------------------------------------------------------
*/

Route::get('/mixandmatch', function () {
    return view('pages.mixandmatch.mixandmatch');
})->name('mixandmatch');

Route::get('/mixandmatch/detail', function () {
    return view('pages.mixandmatch.detail');
})->name('mixandmatch.view_detail');

Route::get('/mixandmatch/{id}', function ($id) {
    return view('pages.mixandmatch.detail', ['id' => $id]);
})->name('mixandmatch.detail');

Route::get('/product/{id}', [ProductController::class, 'show'])
    ->name('product.show');



/*
|--------------------------------------------------------------------------
| Checkout
|--------------------------------------------------------------------------
*/

// STEP 1 - Information
Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout.index');

Route::post('/checkout/information', [CheckoutController::class, 'saveInformation'])
    ->name('checkout.shipping');

// STEP 2 - Shipping
Route::get('/checkout/shipping', [CheckoutController::class, 'shipping'])
    ->name('checkout.shipping.view');

Route::post('/checkout/shipping', [CheckoutController::class, 'storeShipping'])
    ->name('checkout.shipping.store');

// STEP 3 - PAYMENT
Route::get('/checkout/payment', [CheckoutController::class, 'payment'])->name('checkout.payment');
Route::get('/payment/bank/{order}', [PaymentController::class, 'bank'])->name('payment.bank');
Route::get('/payment/qris/{order}', [PaymentController::class, 'qris'])->name('payment.qris');
Route::post('/checkout/confirmation', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
Route::get('/order/success/{order}', [CheckoutController::class, 'success'])->name('order.success');
Route::post('/payment/upload', [PaymentController::class, 'upload'])->name('payment.upload');
Route::get('/payment/upload/{orderId}', [PaymentController::class, 'uploadView']) ->name('payment.upload.view');


// Confirmation
Route::get('/payment/bank/{order}', [PaymentController::class, 'bank'])
     ->name('payment.bank');

Route::get('/payment/qris/{order}', [PaymentController::class, 'qris'])
     ->name('payment.qris');

Route::get('/checkout/confirmation', [CheckoutController::class, 'confirmation'])
     ->name('checkout.confirmation'); // atau checkout.confirmation, bebas asal konsisten


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
| User Protected Routes (Wajib Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // ===== PROFILE (BENAR) =====
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // ===== CART SYSTEM =====
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/delete/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/mixandmatch', [MixAndMatchController::class, 'frontend'])
    ->name('mixandmatch.frontend');

    Route::get('/mixandmatch/{id}', [MixAndMatchController::class, 'detail'])
    ->name('mixandmatch.detail');

    // ini order
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/order-success/{id}', [OrderController::class, 'success']) ->name('orders.success');

});

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

    Route::get('/status_orders', [OrderController::class, 'adminIndex'])->name('status_order');
    Route::put('/admin/status_orders/{order}', [OrderController::class, 'updateStatus'])
    ->name('admin.order.updateStatus');

});


/*
|--------------------------------------------------------------------------
| Review
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/katalog/{id}/review', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
});

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/bestseller', [HomeController::class, 'bestseller'])->name('bestseller');