<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\App;
// use Illuminate\Support\Facades\View;

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
        if(request()->is("*api*")) {
            if(request()->header("Accept-Language") == 'ar') {
                App::setLocale('ar');
            }else{
                App::setLocale('en');
            }
        }
        Schema::defaultStringLength(191);
        date_default_timezone_set('Asia/Riyadh');

        Paginator::defaultView('pagination::pagination');
        Paginator::defaultSimpleView('pagination::pagination');
    }
}
