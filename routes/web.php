<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
    return view('login');
});

Route::get('/logout', function () {
    Session::forget('user');
    return view('login');
});

Route::view('/register', 'register');
Route::post('/register', [UserController::class, 'register']);

Route::post('/login', [UserController::class, 'login']);
Route::get('/', [ProductController::class, 'index']);
Route::get('detail/{id}', [ProductController::class, 'detail']);
Route::get('search', [ProductController::class, 'search']);
Route::post('add_to_cart', [ProductController::class, 'addToCart']);
Route::post('/add_to_cart2', [ProductController::class, 'addToCart2']);
Route::get('cartlist', [ProductController::class, 'cartList']);
Route::get('removecart/{id}', [ProductController::class, 'removeCart']);
Route::get('/ordernow', [ProductController::class, 'orderNow']);
Route::post('/orderplace', [ProductController::class, 'orderPlace']);
Route::get('/myorders', [ProductController::class, 'myOrders']);

// ECPay 回傳到這裡，再做付款狀態更新
Route::post('/callback', [ProductController::class, 'callback']);
// 處理返回商店的連結
Route::get('/success', [ProductController::class, 'redirectFromECpay']);
