
<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.home.home');
})->name('home');

Route::get('/about', function () {
    return view('pages.about.about');
})->name('about');

Route::get('/katalog', function () {
    return view('pages.katalog.katalog');
})->name('katalog');

Route::get('/mixandmatch', function () {
    return view('pages.mixandmatch.mixandmatch');
})->name('mixandmatch');

Route::get('/bestseller', function () {
    return view('pages.home.bestseller');
})->name('bestseller');

Route::get('/admin', function () {
    return view('pages.admin.products');
})->name('admin');

Route::get('/checkout', function () {
    return view('pages.checkout.checkout');
})->name('checkout');

Route::get('/checkout', function () {
    return view('pages.checkout.checkout');
})->name('checkout.information');

Route::post('/checkout/shipping', function () {
    return view('pages.checkout.shipping');
})->name('checkout.shipping');

Route::post('/checkout/payment', function () {
    return view('pages.checkout.payment');
})->name('checkout.payment');

Route::post('/checkout/confirmation', function () {
    return view('pages.checkout.confirmation');
})->name('checkout.confirmation');

Route::get('/admin/add_products', function () {
    return view('pages.admin.add_products');
})->name('add_products');

Route::get('/add_images', function () {
    return view('pages.admin.add_images');
})->name('add_images');

Route::get('/add_mixandmatch', function () {
    return view('pages.admin.add_mixandmatch');
})->name('add_mixandmatch');

Route::get('/admin/add_video', function () {
    return view('pages.admin.add_video');
})->name('add_video');

