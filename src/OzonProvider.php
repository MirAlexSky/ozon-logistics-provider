<?php

namespace Miralexsky\OzonLogisticsProvider;

use Illuminate\Support\ServiceProvider;
use Miralexsky\OzonApi\OzonClient;

class OzonProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
//        $configPath = __DIR__ . '/../config/ozon.php';
//        $publishPath = config_path('ozon.php');

//        $this->publishes([$configPath => $publishPath], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ozon_logistics', function () {
            return new OzonClient(false);
        });

//        $this->mergeConfigFrom(__DIR__.'/../config/dadata.php', 'ozon');
    }

}