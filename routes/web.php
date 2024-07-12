<?php

use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\MenuController;
use App\Models\Expenses;
use App\Models\Menu;
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
Route::get('/forms', function () {
    return view('forms');
})->name('forms');

Route::get('/AddOrder', function () {
    return view('AddOrder');
})->name('AddOrder');


// Expenses Routes        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/ExpensesPage', [ExpensesController::class, 'index'])->name('ExpensesPage');

Route::get('/InsertExpenses', function () {
    return view('InsertExpenses');
})->name('InsertExpenses');

// Inserting Data 
Route::post('/InsertExpenses', function () {
    Expenses::create([
        'E_Name' => request('Name'),
        'E_Type' => request('type'),
        'E_Description' => request('Description'),
        'E_Amount' => request('Amount'),
    ]);
    return redirect('/ExpensesPage');
});
// Deleting
Route::delete('/ExpensesPage/{exp}', [ExpensesController::class, 'destroy'])->name('ExpensesPage.destroy');
// Update
Route::get('/ExpensesPage/{exp}', [ExpensesController::class, 'edit'])->name('ExpensesPage.edit');
Route::put('/ExpensesPage/{exp}', [ExpensesController::class, 'update'])->name('ExpensesPage.update');





// Menu Routes          /////////////////////////////////////////////////////////////////////////////////////////////////////////////
Route::get('/MenuPage', [MenuController::class, 'index'])->name('MenuPage');
Route::delete('/MenuPage/{me}', [MenuController::class, 'destroy'])->name('MenuPage.destroy');

Route::get('/InsertMenu', function () {
    return view('InsertMenu');
})->name('InsertMenu');


// Inserting Data 
Route::post('/InsertMenu', function () {
    Menu::create([
        'm_Name' => request('name'),
        'm_Price' => request('price'),
        'm_category' => request('category'),
    ]);
    return redirect('/MenuPage');
});




// Storage Routes       /////////////////////////////////////////////////////////////////////////////////////////////////////////////

Route::get('/StoragePage', [StorageController:: class, 'index'])->name('StoragePage');
// Inserting items in storage 
Route::get('/InsertItems', function () {
    return view('InsertItems');
})->name('InsertItems');
Route::post('InsertItems', [StorageController::class, 'store'])->name('InsertItems');

Route::get('/AddItems', function () {
    return view('AddItems');
})->name('AddItems');
Route::get('/AddItems', [StorageController:: class, 'showItems'])->name('AddItems');
Route::post('AddItems', [StorageController::class, 'AddItems'])->name('AddItems');

// Delete
Route::delete('/StoragePage/{exp}', [StorageController::class, 'destroy'])->name('StoragePage.destroy');



