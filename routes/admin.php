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
    // Admin Logout
    Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');
    // Admin Password Change
    Route::get('/admin/password/change', 'AdminController@adminPassword')->name('admin.password.change');
    // Admin Password Update
    Route::post('/admin/password/update', 'AdminController@passwordUpdate')->name('admin.password.update');

    // Category CRUD
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', 'CategoryController@index')->name('category.index');
        Route::post('/store', 'CategoryController@store')->name('category.store');
        Route::get('/destroy/{id}', 'CategoryController@destroy')->name('category.delete');
        Route::get('/edit/{id}', 'CategoryController@edit');
        Route::post('/update', 'CategoryController@update')->name('category.update');
    });

    // Global route
    Route::get('/get-sub-category/{id}', 'CategoryController@getSubCategory');
    Route::get('/get-child-category/{id}', 'CategoryController@getChildCategory');

    // SubCategory CRUD
    Route::group(['prefix' => 'subcategory'], function () {
        Route::get('/', 'SubCategoryController@index')->name('subcategory.index');
        Route::post('/store', 'SubCategoryController@store')->name('subcategory.store');
        Route::get('/destroy/{id}', 'SubCategoryController@destroy')->name('subcategory.delete');
        Route::get('/edit/{id}', 'SubCategoryController@edit');
        Route::post('/update', 'SubCategoryController@update')->name('subcategory.update');
    });

    // ChildCategory CRUD
    Route::group(['prefix' => 'childcategory'], function () {
        Route::get('/', 'ChildCategoryController@index')->name('childcategory.index');
        Route::post('/store', 'ChildCategoryController@store')->name('childcategory.store');
        Route::get('/destroy/{id}', 'ChildCategoryController@destroy')->name('childcategory.delete');
        Route::get('/edit/{id}', 'ChildCategoryController@edit');
        Route::post('/update', 'ChildCategoryController@update')->name('childcategory.update');
    });

    // Warehouse CRUD
    Route::group(['prefix' => 'warehouse'], function () {
        Route::get('/', 'WareHouseController@index')->name('warehouse.index');
        Route::post('/store', 'WareHouseController@store')->name('warehouse.store');
        Route::get('/destroy/{id}', 'WareHouseController@destroy')->name('warehouse.delete');
        Route::get('/edit/{id}', 'WareHouseController@edit');
        Route::post('/update', 'WareHouseController@update')->name('warehouse.update');
    });

    // BRAND CRUD
    Route::group(['prefix' => 'brand'], function () {
        Route::get('/', 'BrandController@index')->name('brand.index');
        Route::post('/store', 'BrandController@store')->name('brand.store');
        Route::get('/destroy/{id}', 'BrandController@destroy')->name('brand.delete');
        Route::get('/edit/{id}', 'BrandController@edit');
        Route::post('/update', 'BrandController@update')->name('brand.update');
    });

    // Product section
    // Product CRUD
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', 'ProductController@index')->name('product.index');
        Route::get('/create', 'ProductController@create')->name('product.create');
        Route::post('/store', 'ProductController@store')->name('product.store');
        Route::delete('/destroy/{id}', 'ProductController@destroy')->name('product.delete');
        // Route::get('/edit/{id}', 'ProductController@edit');
        // Route::post('/update', 'ProductController@update')->name('pickuppoint.update');
        
        // Active & Deactive Featured,Status,Today deal
        Route::get('/deactive_featured/{id}', 'ProductController@deactive_featured');
        Route::get('/active_featured/{id}', 'ProductController@active_featured');
        Route::get('/deactive_today_deal/{id}', 'ProductController@deal_deactive');
        Route::get('/active_today_deal/{id}', 'ProductController@deal_active');
        Route::get('/deactive_status/{id}', 'ProductController@status_deactive');
        Route::get('/active_status/{id}', 'ProductController@status_active');
    });

    // Pickup Point Section
    // pickup point CRUD
    Route::group(['prefix' => 'pickuppoint'], function () {
        Route::get('/', 'PickupPointController@index')->name('pickuppoint.index');
        Route::post('/store', 'PickupPointController@store')->name('pickuppoint.store');
        Route::delete('/destroy/{id}', 'PickupPointController@destroy')->name('pickuppoint.delete');
        Route::get('/edit/{id}', 'PickupPointController@edit');
        Route::post('/update', 'PickupPointController@update')->name('pickuppoint.update');
    });

    // Offers Section
    // coupon CRUD
    Route::group(['prefix' => 'coupon'], function () {
        Route::get('/', 'CouponController@index')->name('coupon.index');
        Route::post('/store', 'CouponController@store')->name('coupon.store');
        Route::delete('/destroy/{id}', 'CouponController@destroy')->name('coupon.delete');
        Route::get('/edit/{id}', 'CouponController@edit');
        Route::post('/update', 'CouponController@update')->name('coupon.update');
    });

    // Setting
    Route::group(['prefix' => 'setting'], function () {
        // SEO
        Route::group(['prefix' => 'seo'], function () {
            Route::get('/seo', 'SettingController@seoIndex')->name('seo.setting');
            Route::post('/update/{id}', 'SettingController@seoUpdate')->name('seo.setting.update');
        });

        // SMTP Setting
        Route::group(['prefix' => 'smtp'], function () {
            Route::get('/', 'SettingController@smtpIndex')->name('smtp.setting');
            Route::post('/update/{id}', 'SettingController@smtpUpdate')->name('smtp.setting.update');
        });

        // Page Setting
        Route::group(['prefix' => 'page'], function () {
            Route::get('/', 'SettingController@pageIndex')->name('page.index');
            Route::get('/create', 'SettingController@pageCreate')->name('page.create');
            Route::post('/store', 'SettingController@pageStore')->name('page.store');
            Route::get('/destroy/{id}', 'SettingController@pageDestroy')->name('page.delete');
            Route::get('/edit/{id}', 'SettingController@pageEdit')->name('page.edit');
            Route::post('/update{id}', 'SettingController@pageUpdate')->name('page.update');
        });

        // SMTP Setting
        Route::group(['prefix' => 'websitesetting'], function () {
            Route::get('/', 'SettingController@website')->name('website.setting');
            Route::post('/update/{id}', 'SettingController@websiteUpdate')->name('website.setting.update');
        });
    });

});
