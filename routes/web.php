<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MethodController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes(['register' => false]);
Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    //inventaire:

    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('methods', MethodController::class);
    Route::resource('transactions', TransactionController::class)->except(['create', 'show']);
    Route::resource('sales', SaleController::class)->except(['edit', 'update']);

    Route::get('/stats/{year?}/{month?}/{day?}', [TransactionController::class, 'stats'])->name('stats');
    Route::get('transactions/{type}', [TransactionController::class, 'type'])->name('transactions.type');
    Route::get('transactions/{type}/create', [TransactionController::class, 'create'])->name('transactions.create');
    Route::get('sales/{sale}/finalize', [SaleController::class, 'finalize'])->name('sales.finalize');
    Route::get('sales/{sale}/product/add', [SaleController::class, 'addproduct'])->name('sales.product.add');
    Route::post('sales/{sale}/product', [SaleController::class, 'storeproduct'])->name('sales.product.store');
    Route::get('sales/{sale}/product/{soldproduct}/edit', [SaleController::class, 'editproduct'])->name('sales.product.edit');
    Route::delete('sales/{sale}/product/{soldproduct}', [SaleController::class, 'destroyproduct'])->name('sales.product.destroy');
    Route::put('sales/{sale}/product/{soldproduct}', [SaleController::class, 'updateproduct'])->name('sales.product.update');
    Route::get('customers/{customer}/transactions/add', [CustomerController::class, 'addtransaction'])->name('customers.transactions.add');
    Route::get('sales/{sale}/addtransaction', [SaleController::class, 'addtransaction'])->name('sales.addtransaction');
    Route::post('sales/{sale}/addtransaction', [SaleController::class, 'storetransaction'])->name('sales.transaction.store');
    Route::get('inventory/stats/{year?}/{month?}/{day?}', [InventoryController::class, 'stats'])->name('inventory.stats');

    //settings route
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('settings/create', [SettingsController::class, 'create'])->name('settings.create');
    Route::post('settings/store', [SettingsController::class, 'store'])->name('settings.store');
    Route::get('settings/edit/{id}', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('settings/update/{id}', [SettingsController::class, 'update'])->name('settings.update');
    //end settings route
    Route::get('/download-pdf/{id}', [SaleController::class, 'downloadPDF'])->name('downloadPDF');
    Route::get('sales/todaysale', [SaleController::class, 'TodaySale'])->name('sales.todaysale');
    Route::get('qrcode/{id}', [ProductController::class, 'generate'])->name('generate');


});
