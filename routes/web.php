<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UpdatePassword;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\UpdatePasswordController;
use App\Http\Controllers\DashboardPostinganController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\UbahPasswordController;

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

Route::get('/', [PostinganController::class, 'index']);
Route::get('/singlepost/{postingan:slug}', [PostinganController::class, 'show']);
Route::get('/search', [PostinganController::class, 'search'])->name('search');

Route::post('/postingan/komentar', [InteractionController::class, 'komentar'])->middleware('auth');
Route::get('/postingan/like/{postingan_id}', [LikeController::class, 'toggle'])->middleware('auth');

Route::get('/categories/{category:slug}', [CategoryController::class, 'show']);


Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('admin');

Route::resource('/dashboard/postingan', DashboardPostinganController::class)->middleware('admin');
Route::resource('/dashboard/user', DashboardUserController::class)->middleware('admin');

Route::get('/password.edit', [UbahPasswordController::class, 'index'])->middleware('auth');
Route::put('/password.edit', [UbahPasswordController::class, 'update'])->middleware('auth');