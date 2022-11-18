<?php

use App\Http\Controllers\Admin\TeaController as AdminTeaController;
use App\Http\Controllers\User\TeaController as UserTeaController;
use Database\Seeders\TeaSeeder;
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


// Route::get('/index', function () {
//     return view('teas.index');
// })->middleware(['auth', 'verified'])->name('index');

// Route::get('/show', function () {
//     return view('teas.show');
// })->middleware(['auth', 'verified'])->name('show');

require __DIR__ . '/auth.php';

//makes routes automatically for all pages
Route::resource('/teas', TeaController::class)->middleware(['auth']);



// This will create all the routes for Tea
Route::resource('/admin/teas', AdminTeaController::class)->middleware(['auth'])->names('admin.teas');

// and the routes will only be available when a user is logged in
Route::resource('/user/teas', UserTeaController::class)->middleware(['auth'])->names('user.teas')->only(['index', 'show']);
