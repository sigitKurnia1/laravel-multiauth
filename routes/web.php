<?php

use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

Route::group(['middleware' => 'guest'], function() {
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::get('/login', [MainController::class, 'login_form'])->name('login-form');
    Route::get('/register', [MainController::class, 'register_form'])->name('register-form');
    Route::post('/post-login', [MainController::class, 'post_login'])->name('post-login');
    Route::post('/post-register', [MainController::class, 'post_register'])->name('post-register');
})->middleware('guest');

Route::group(['middleware' => 'admin'], function() {
    Route::get('/admin-dashboard', [MainController::class, 'admin_dashboard'])->name('admin-dashboard');
    Route::get('/admin-logout', [MainController::class, 'admin_logout'])->name('admin-logout');
    Route::get('/create-form', [AdminController::class, 'create_form'])->name('create-form');
    Route::post('/post-create', [AdminController::class, 'post_create'])->name('post-create');
    Route::get('/update-form/{id}', [AdminController::class, 'update_form'])->name('update-form');
    Route::post('/post-update/{id}', [AdminController::class, 'post_update'])->name('post-update');
    Route::delete('/delete-user/{id}', [AdminController::class, 'delete'])->name('delete-user');
    Route::get('/search-user', [AdminController::class, 'search_user'])->name('search-user');
})->middleware('admin');

Route::group(['middleware' => 'web'], function() {
    Route::get('/user-dashboard', [MainController::class, 'user_dashboard'])->name('user-dashboard');
    Route::get('/user-logout', [MainController::class, 'user_logout'])->name('user-logout');
})->middleware('web');