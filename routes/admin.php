<?php

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
// Admin Login
Route::get('/admin-login',[App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');

//Admin Home
Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
