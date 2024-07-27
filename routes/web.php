<?php

use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Models\Expenses;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;


// Login Routes ==========================
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'login']);
Route::get('Javedsultanzai:5428665', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('Javedsultanzai:5428665', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// Protected Routes ==========================

Route::middleware('auth')->group(function () {

    Route::get('/ExpensesReport', [ExpensesController::class, 'Report'])->name('ExpensesReport');

    // Expenses Routes
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

    // Menu Routes
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

    // Storage Routes
    Route::get('/StoragePage', [StorageController::class, 'index'])->name('StoragePage');
    Route::get('/InsertItems', function () {
        return view('InsertItems');
    })->name('InsertItems');
    Route::post('InsertItems', [StorageController::class, 'store'])->name('InsertItems');

    Route::get('/AddItems', function () {
        return view('AddItems');
    })->name('AddItems');
    Route::get('/AddItems', [StorageController::class, 'showItems'])->name('AddItems');
    Route::post('AddItems', [StorageController::class, 'AddItems'])->name('AddItems');

    // Delete
    Route::delete('/StoragePage/{exp}', [StorageController::class, 'destroy'])->name('StoragePage.destroy');

    // Report
    Route::get('/StorageReport', [StorageController::class, 'Report'])->name('StorageReport');

    // Order Routes
    Route::get('/OrderPage', [OrderController::class, 'index'])->name('OrderPage');
    Route::get('/AddOrder', [OrderController::class, 'create'])->name('AddOrder');
    Route::post('/AddOrder', [OrderController::class, 'store'])->name('AddOrder');

    // Editing Order
    Route::get('/EditOrder/{id}', [OrderController::class, 'edit'])->name('EditOrder');
    Route::post('/OrderPage/{id}', [OrderController::class, 'update'])->name('orders.update');

    // Deleting
    Route::delete('/OrderPage/{ord}', [OrderController::class, 'destroy'])->name('OrderPage.destroy');

    // Print Order
    Route::get('/PrintOrder/{orderId}', [OrderController::class, 'show'])->name('PrintOrder');

    // Report
    Route::get('/OrderReport', [OrderController::class, 'Report'])->name('OrderReport');

    // Dashboard
    Route::get('/dashboard', [ReportController::class, 'DashboardReport'])->name('dashboard');



    // Bill Pages  ==============================================================
    Route::get('/BillPage', [BillController::class, 'index'])->name('BillPage');

    Route::get('/create_bill', [BillController::class, 'create'])->name('bills.create');
    Route::post('/create_bill', [BillController::class, 'store'])->name('bills.store');
    Route::get('/UpdateBill/{id}/edit', [BillController::class, 'edit'])->name('bills.edit');
    Route::put('/UpdateBill/{id}', [BillController::class, 'update'])->name('bills.update');
    Route::delete('/BillPage/{id}', [BillController::class, 'destroy'])->name('BillPage.destroy');
    
    // Print Bill Page
    Route::get('/PrintBill/{id}', [BillController::class, 'show'])->name('PrintBill');




});
