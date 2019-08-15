<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Home\ShopCarController;
use App\Http\Controllers\Home\IndexController;
use App\Http\Controllers\Home\LayoutController;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       
        Schema::defaultStringLength(191);

        //共享数据
        View::share('common_cates_data',IndexController::getPidCateData());
        View::share('number',ShopCarController::number());
        View::share('link', LayoutController::index());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
