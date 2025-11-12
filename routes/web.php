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

