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
Route::get('/admin-login', [App\Http\Controllers\Auth\LoginController::class, 'adminLogin'])->name('admin.login');

// Group Route
Route::group(['namespace' => 'App\Http\Controllers\admin', 'middleware' => 'is_admin'], function () {
    //Admin Home
    Route::get('/admin/home', 'AdminController@adminHome')->name('admin.home');
    Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');


});
