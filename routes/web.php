<?php

use App\Http\Controllers\LoginController;
use App\Http\Middleware\AdminMiddleware;
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
    return view('welcome');
});
Route::middleware(AdminMiddleware::class)->group(
    function () {
Route::get('/listAccount', [LoginController::class, 'listAccount'])->name('account.list');
Route::put('/listAccount/{user}', [LoginController::class, 'setAble'])->name('account.setAble');

});

Route::get('/detail', [LoginController::class, 'detail'])->name('user.detail');

Route::get('/user/edit/{user}', [LoginController::class, 'edit'])->name('user.edit');
Route::put('/user/edit/{user}', [LoginController::class, 'update'])->name('user.update');

Route::get('/user/changePass/{user}', [LoginController::class, 'toChange'])->name('user.changePass');
Route::put('/user/changePass/{user}', [LoginController::class, 'changePass'])->name('user.changePass');




Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::Post('/login', [LoginController::class, 'postLogin'])->name('postLogin');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register', [LoginController::class, 'postRegister'])->name('postRegister');