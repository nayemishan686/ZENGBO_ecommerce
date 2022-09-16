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

    // Register
    Route::get('/register','IndexController@register')->name('register');
    
    // Register
    // Route::get('/login',function(){
    //     return "Hi";
    // });

    //Admin Home
    Route::get('/', 'IndexController@index');
    //Product Details
    Route::get('/product-details/{slug}', 'IndexController@productDetails')->name('product.details');
    Route::get('/product-quick-view/{id}', 'IndexController@ProductQuickView');

    // Cart CRUD
    Route::group(['prefix' => 'cart'], function () {
        Route::post('/addToCart/quickView', 'CartController@addToCartQV')->name('add.to.cart.quickview');
        // Route::post('/store', 'SubCategoryController@store')->name('subcategory.store');
        // Route::get('/destroy/{id}', 'SubCategoryController@destroy')->name('subcategory.delete');
        // Route::get('/edit/{id}', 'SubCategoryController@edit');
        // Route::post('/update', 'SubCategoryController@update')->name('subcategory.update');
    });


    //Customer Logout
    Route::get('/logout', 'IndexController@customerLogout')->name('customer.logout');

    //Review
    Route::post('/review/store', 'ReviewController@store')->name('review.store');
    Route::get('/wishlist/add/{id}', 'ReviewController@wishlistAdd')->name('add.wishlist');

});