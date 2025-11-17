<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

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

Route::get('/admin', function () {
    return view('pages.admin.products');
})->name('admin');

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

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/register', function () {
    return view('pages.register');
})->name('register');

Route::get('/profile', function () {
    return view('pages.profile.profile');
})->name('profile');

Route::get('/cart', function () {
    return view('pages.checkout.cart');
})->name('cart');

Route::get('/admin/video', function () {
    return view('pages.admin.video');
})->name('admin.video');

Route::get('/admin/images', function () {
    return view('pages.admin.images');
})->name('admin.images');

Route::get('/katalog/detail', function () {
    return view('pages.katalog.detail');
})->name('produk.detail');
