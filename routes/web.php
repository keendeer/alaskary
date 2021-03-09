<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function(){
	Route::resource('branch', App\Http\Controllers\Dashboard\BranchController::class);
	Route::get('branch/{branch}/exchange', [App\Http\Controllers\Dashboard\BranchController::class, 'branchExchange'])->name('branch.branchExchange');
	Route::resource('itemtobranch', App\Http\Controllers\Dashboard\BranchItemController::class);
	Route::resource('client', App\Http\Controllers\Dashboard\ClientController::class);
	Route::resource('category', App\Http\Controllers\Dashboard\CategoryController::class);
	Route::get('item/invoice', [App\Http\Controllers\Dashboard\ItemController::class, 'itemForInvoice'])->name('item.itemForInvoice');
	Route::get('item/qty', [App\Http\Controllers\Dashboard\ItemController::class, 'getQuantity'])->name('item.getQuantity');
	Route::resource('item', App\Http\Controllers\Dashboard\ItemController::class);
	Route::resource('user', App\Http\Controllers\Dashboard\UserController::class);
	Route::resource('employee', App\Http\Controllers\Dashboard\EmployeeController::class);
	Route::resource('salesorder', App\Http\Controllers\Dashboard\SalesOrderController::class);
	Route::resource('exchange', App\Http\Controllers\Dashboard\ExchangeController::class);
	Route::resource('employee_timeline', App\Http\Controllers\Dashboard\EmployeeTimelineController::class);
});
