<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('frontend.index');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Group Route
Route::group(['namespace' => 'App\Http\Controllers\frontend'], function () {

    //Admin Home
    Route::get('/', 'IndexController@index');
    //Product Details
    Route::get('/product-details/{slug}', 'IndexController@productDetails')->name('product.details');
});