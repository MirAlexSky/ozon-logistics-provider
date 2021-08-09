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
        $configPath = __DIR__ . '/../config/ozon.php';
        $publishPath = $this->app->basePath('config/ozon.php');

        $this->publishes([$configPath => $publishPath]);
        $this->loadRoutesFrom(__DIR__.'/routes.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ozon_logistics', function () {

            $clientId = $this->app->make('config')->get('ozon.clientId');
            $clientSecret = $this->app->make('config')->get('ozon.clientSecret');
            $isProd = !!$this->app->make('config')->get('ozon.isProd');

            $ozonClient =  new OzonClient($isProd);
            if ($isProd) {
                $ozonClient->setCredentials($clientId, $clientSecret);
            }

            return $ozonClient;

        });

        $this->mergeConfigFrom(__DIR__.'/../config/ozon.php', 'ozon');
    }

}