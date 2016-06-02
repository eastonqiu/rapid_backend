<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Cookie\Middleware\EncryptCookies;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->resolving(EncryptCookies::class, function ($object) {
            // need check the ip
            $object->disableFor('token');
        });
    }
}
