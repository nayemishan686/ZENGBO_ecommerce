<?php

use App\Http\Controllers\admin\CategoryController;
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
    // Admin Logout
    Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');

    // Category CRUD
    Route::group(['prefix' => 'category'], function(){
        Route::get('/index', 'CategoryController@index')->name('category.index');
        Route::post('/store', 'CategoryController@store')->name('category.store');
        Route::get('/destroy/{id}', 'CategoryController@destroy')->name('category.delete');
        Route::get('/edit/{id}','CategoryController@edit');
        Route::post('/update', 'CategoryController@update')->name('category.update');
    });

});
