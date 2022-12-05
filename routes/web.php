<?php

use App\Http\Controllers\Admin\TeaController as AdminTeaController;
use App\Http\Controllers\User\TeaController as UserTeaController;

use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\User\BrandController as UserBrandController;

use App\Http\Controllers\Admin\StoreController as AdminStoreController;
use App\Http\Controllers\User\StoreController as UserStoreController;

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//makes routes automatically for all pages
require __DIR__ . '/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');
Route::get('/home/brands', [App\Http\Controllers\HomeController::class, 'brandIndex'])->name('home.brand.index');
Route::get('/home/stores', [App\Http\Controllers\HomeController::class, 'storeIndex'])->name('home.store.index');


// This will create all the routes for Tea
Route::resource('/admin/teas', AdminTeaController::class)->middleware(['auth'])->names('admin.teas');
// and the routes will only be available when a user is logged in
Route::resource('/users/teas', UserTeaController::class)->middleware(['auth'])->names('users.teas')->only(['index', 'show']);

Route::resource('/admin/brands', AdminBrandController::class)->middleware(['auth'])->names('admin.brands');
Route::resource('/user/brands', UserBrandController::class)->middleware(['auth'])->names('user.brands')->only(['index', 'show']);

Route::resource('/admin/stores', AdminStoreController::class)->middleware(['auth'])->names('admin.stores');