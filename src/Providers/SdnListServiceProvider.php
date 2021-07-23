<?php

namespace Jota\SdnList\Providers;

use Illuminate\Support\ServiceProvider;
use Jota\SdnList\Classes\SdnList;

class SdnListServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() : void
    {
        $this->app->bind('SdnList', function () {
            return new SdnList();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() : void
    {
        $this->publishes([
            __DIR__ . '/../../config/sdnlist.php' => config_path('sdnlist.php'),
        ]);
    }
}
