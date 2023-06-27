<?php

use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TipeController;
use App\Http\Controllers\TransaksiController;

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

Auth::routes();


Route::resource('product', ProductController::class);
Route::post('product/aktifkan', [ProductController::class, 'aktifkan'])->name('product.aktifkan');
Route::post('product/nonaktifkan', [ProductController::class, 'nonaktifkan'])->name('product.nonaktifkan');

Route::resource('transaksi', TransaksiController::class);


// Owner Route
Route::group(['middleware' => ['auth', 'role:owner'], 'prefix' => 'owner'], function () {
    Route::resource('/dashboard', OwnerController::class)->names('owner.dashboard')->only(['index']);
});

// Staff Route
Route::group(['middleware' => ['auth', 'role:staff'], 'prefix' => 'staff'], function () {
    Route::resource('/dashboard', StaffController::class)->names('staff.dashboard')->only(['index']);
});

//Admin Route (Owner & Staff)
Route::group(['middleware' => ['auth', 'role:staff,owner'], 'prefix' => 'admin'], function () {
    Route::resource('/type', TipeController::class)->names('admin.type')->only(['index']);
    Route::resource('/category', KategoriController::class)->names('admin.category');
    Route::get('/category/{category}/restore', [KategoriController::class, 'restore'])->name('admin.category.restore');
});


//Mencegah staff & owner ke route ( / ) setelah login
Route::get('/', function () {
    // return view('welcome');
    $user = Auth::user();
    if ($user && $user->hasRole('owner')) {
        return redirect()->route('owner.dashboard.index');
    } else if ($user && $user->hasRole('staff')) {
        return redirect()->route('staff.dashboard.index');
    } else {
        return view('welcome');
    }
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/transaksi/{bulan?}/{tahun?}', [TransaksiController::class, 'index'])->name('transaksi.index');
