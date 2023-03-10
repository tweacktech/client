<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;
use app\Http\Controllers\DealerController;
use app\Http\Controllers\CorporateController;
use app\Http\Controllers\ProductController;
use app\Http\Controllers\OrderController;
use app\Http\Controllers\InvoiceController;
use app\Models\Dealer;
use app\Http\Middleware\IsAdmin;
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

// Route::get('/', function () {
//     return view('dist.landing');
// });
Route::post('/order', [App\Http\Controllers\OrderController::class, 'store']);
Route::get('/invoice', [App\Http\Controllers\InvoiceController::class, 'index'])->middleware('is_admin');
Route::get('/approveinvoice/{id}', [App\Http\Controllers\InvoiceController::class, 'show'])->middleware('is_admin');
Route::post('/invoice', [App\Http\Controllers\InvoiceController::class, 'store']);
Route::get('/buy/{id}', [App\Http\Controllers\ProductController::class, 'show']);

Route::get('/invoice/{id}', [App\Http\Controllers\OrderController::class, 'show']);


Route::get('/index', function () {
    return view('dist.index');
});
Route::get('/dealer', function () {
    return view('dist.apps.customers.dealer');
});
Route::get('/corporate', function () {
    return view('dist.apps.customers.corporate');
});


// storing data for Dealer
Route::get('/iapprove/{user_code}', [App\Http\Controllers\InvoiceController::class, 'approve'])->middleware('is_admin');
Route::get('/isuspend/{user_code}', [App\Http\Controllers\InvoiceController::class, 'suspend'])->middleware('is_admin');
Route::get('/ide_activate/{user_code}', [App\Http\Controllers\InvoiceController::class, 'de_activate'])->middleware('is_admin');
// Dealers actions
Route::get('/approve/{user_code}', [App\Http\Controllers\DealerController::class, 'approve'])->middleware('is_admin');
Route::get('/suspend/{user_code}', [App\Http\Controllers\DealerController::class, 'suspend'])->middleware('is_admin');
Route::get('/de_activate/{user_code}', [App\Http\Controllers\DealerController::class, 'de_activate'])->middleware('is_admin');

Route::get('/overv/{user_code}', [App\Http\Controllers\DealerController::class, 'show'])->middleware('is_admin');
Route::post('/dstore', [App\Http\Controllers\DealerController::class, 'store']);
// retrieving data not on pendding
Route::get('/dealers', [App\Http\Controllers\DealerController::class, 'index'])->name('admin.home')->middleware('is_admin');
// storing data for Dealer
Route::post('/cstore', [App\Http\Controllers\CorporateController::class, 'store']);
// retrieving data not on pendding
// Route::get('/corporates', [App\Http\Controllers\CorporateController::class, 'index'])
;
Auth::routes();
Route::get('/home', [App\Http\Controllers\DealerController::class, 'sales']);
Route::get('/', [App\Http\Controllers\DealerController::class, 'index'])->name('admin.home')->middleware('is_admin');
