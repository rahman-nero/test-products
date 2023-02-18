<?php

use App\Http\Controllers\User\Auth\LoginController as ConsumerLoginControllerAlias;
use App\Http\Controllers\User\Auth\RegisterController as ConsumerRegisterControllerAlias;
use App\Http\Controllers\User\ConsumerController;
use App\Http\Controllers\User\RequestController;
use App\Http\Controllers\Seller\Auth\LoginController as SellerLoginControllerAlias;
use App\Http\Controllers\Seller\Auth\RegisterController as SellerRegisterControllerAlias;


use App\Http\Controllers\Seller\ProductsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $user = Auth::user();

    if ($user->hasRole('seller')) {
        return redirect()->route('seller.main');
    }

    if ($user->hasRole('consumer')) {
        return redirect()->route('user.main');
    }
});


// Вход для пользователя
Route::get('/user/login', [ConsumerLoginControllerAlias::class, 'index'])->name('user.login');
Route::post('/user/login', [ConsumerLoginControllerAlias::class, 'store'])->name('user.login.store');

// Регистрация для пользователя
Route::get('/user/register', [ConsumerRegisterControllerAlias::class, 'index'])->name('user.register');
Route::post('/user/register', [ConsumerRegisterControllerAlias::class, 'store'])->name('user.register.store');


// Вход для продавца
Route::get('/seller/login', [SellerLoginControllerAlias::class, 'index'])->name('seller.login');
Route::post('/seller/login', [SellerLoginControllerAlias::class, 'store'])->name('seller.login.store');

// Регистрация для продавца
Route::get('/seller/register', [SellerRegisterControllerAlias::class, 'index'])->name('seller.register');
Route::post('/seller/register', [SellerRegisterControllerAlias::class, 'store'])->name('seller.register.store');


Route::middleware('auth')->group(function () {

    // Доступ будут иметь только пользователи
    Route::middleware('role:consumer')->group(function () {

        // Показ всех запросов
        Route::get('/requests', [RequestController::class, 'index'])->name('user.main');

        // Страница добавление нового запроса
        Route::get('/requests/add', [RequestController::class, 'create'])->name('user.request.add');

        // Обработка нового запроса
        Route::post('/requests/add', [RequestController::class, 'store'])->name('user.request.add.store');

        // Показ определенного запроса
        Route::get('/requests/{id}', [RequestController::class, 'show'])->name('user.request.show');

    });


    // Доступ будут иметь только продавцы
    Route::middleware('role:seller')->group(function () {

        // Показ всех товаров продавца
        Route::get('/products', [ProductsController::class, 'index'])->name('seller.main');

        // Страница добавления товара
        Route::get('/products/add', [ProductsController::class, 'create'])->name('seller.product.add');

        // Обработка нового товара
        Route::post('/products/add', [ProductsController::class, 'store'])->name('seller.product.add.store');

        // Показ товара с выводом списком пользователей которые ищут такой товар
        Route::get('/products/{id}', [ProductsController::class, 'show'])->name('seller.product.show');
    });


});
