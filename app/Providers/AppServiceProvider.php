<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //setting passed whole application
        $setting = DB::table('settings')->first();
        view()->share('setting',$setting);

        //category pass whole application
        $category = DB::table('categories')->get();
        view()->share('category',$category);

    }
}
