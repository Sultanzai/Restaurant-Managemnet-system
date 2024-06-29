<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
Route::get('/order-page', function () {
    return view('orderpage');
})->name('OrderPage');

Route::get('/menu-page', function () {
    return view('menupage');
})->name('MenuPage');

Route::get('/storage-page', function () {
    return view('storagepage');
})->name('StoragePage');
