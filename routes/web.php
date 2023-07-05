<?php

use App\Http\Controllers\BuyerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\laporanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TipeController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\WishlistController;
use App\Models\Product;

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
Route::resource('buyer', BuyerController::class);


Route::post('product/aktifkan', [ProductController::class, 'aktifkan'])->name('product.aktifkan');
Route::post('product/nonaktifkan', [ProductController::class, 'nonaktifkan'])->name('product.nonaktifkan');

Route::post('product/showDetail', [ProductController::class, 'showDetail'])->name('product.showDetail');

Route::post('product/addWishlist', [ProductController::class, 'addWishlist'])->name('product.addWishlist');
Route::post('product/removeWishlist', [ProductController::class, 'removeWishlist'])->name('product.removeWishlist');
Route::post('product/setSessionJual', [ProductController::class, 'setSessionJual'])->name("product.setSessionJual");

Route::resource('transaksi', TransaksiController::class);
Route::get('transaksi/detail/{idTransaksi}', [TransaksiController::class, 'detailTransaksi'])->name('transaksi.detailTransaksi');


// Owner Route
Route::group(['middleware' => ['auth', 'role:owner'], 'prefix' => 'owner'], function () {
    Route::resource('/dashboard', OwnerController::class)->names('owner.dashboard')->only(['index']);

    //Register staff account by owner
    Route::get('/register', [StaffController::class, 'formRegister'])->name('owner.staff.register');
    Route::post('/registeraccount', [StaffController::class, 'register'])->name('owner.staff.registeraccount');

    //Activate staff account by owner
    Route::get('/activate{id}', [StaffController::class, 'formActivate'])->name('owner.staff.activate');
    Route::post('/verified', [StaffController::class, 'verifiedAccount'])->name('owner.staff.verified');
});

// Staff Route
Route::group(['middleware' => ['auth', 'role:staff'], 'prefix' => 'staff'], function () {
    Route::resource('/dashboard', StaffController::class)->names('staff.dashboard')->only(['index']);
});

//Admin Route (Owner & Staff)
Route::group(['middleware' => ['auth', 'role:staff,owner'], 'prefix' => 'admin'], function () {
    //type route
    Route::resource('/type', TipeController::class)->names('admin.type');
    Route::get('/type/{type}/restore', [TipeController::class, 'restore'])->name('admin.type.restore');

    //category route
    Route::resource('/category', KategoriController::class)->names('admin.category');
    Route::get('/category/{category}/restore', [KategoriController::class, 'restore'])->name('admin.category.restore');

    //list staff route
    Route::resource('/staff', StaffController::class)->names('admin.staff');
    Route::get('/staff/{staff}/restore', [StaffController::class, 'restore'])->name('admin.staff.restore');

    //list member & non member route
    Route::get('/memberlist', [BuyerController::class, 'getmember'])->name('admin.member.memberlist');
    Route::post('/memberlist/update', [BuyerController::class, 'updatemembership'])->name('admin.member.updatemembership');

    //list produk terjual
    Route::get('/productsold', [ProductController::class, 'productsold'])->name('admin.product.productsold');
    Route::get('/productsold/{bulan?}/{tahun?}/{filter?}', [ProductController::class, 'productsoldfiltered'])->name('admin.product.productsoldfiltered');

});


//Mencegah staff & owner ke route ( / ) setelah login
Route::get('/', function () {
    // return view('welcome');
    $user = Auth::user();
    if ($user && $user->hasRole('owner')) {
        return redirect()->route('owner.dashboard.index');
    } else if ($user && $user->hasRole('staff')) {
        return redirect()->route('staff.dashboard.index');
    } else if ($user && $user->hasRole('buyer')) {
        return redirect()->to('/product');
    } else {
        return redirect()->route('login');
    }
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/transaksi/{bulan?}/{tahun?}', [TransaksiController::class, 'index'])->name('transaksi.index');

Route::get('/wishlist/{produk?}/{buyer?}', [WishlistController::class, 'store'])->name('wishlist.store');

Route::get('/wishlist/{produk?}/{buyer?}', [WishlistController::class, 'store'])->name('wishlist.store');

Route::get('/laporan/produk/{bulan?}/{tahun?}/{filter?}', [laporanController::class, 'laporanproduk'])->name('laporan.produk');
Route::get('/laporan/pembeli/{filter?}', [laporanController::class, 'laporanpembeli'])->name('laporan.pembeli');


Route::get('/cart', [ProductController::class, 'cart'])->name('produk.cart');
Route::post('/addCart', [ProductController::class, 'addToCart'])->name('addToCart');
Route::post('/removeProductCart', [ProductController::class, 'removeProductCart'])->name('removeProductCart');
Route::post('/updateQuantity', [ProductController::class, 'updateQuantity'])->name('updateQuantity');

Route::get('/saldo', [BuyerController::class, 'showSaldo'])->name('saldo');
Route::get('/topUpSaldo', [BuyerController::class, 'topUpSaldo'])->name('topUpSaldo');
