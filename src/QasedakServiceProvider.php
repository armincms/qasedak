<?php

namespace Armincms\Qasedak;
 
use Illuminate\Support\ServiceProvider; 
use Illuminate\Contracts\Support\DeferrableProvider;

class QasedakServiceProvider extends ServiceProvider implements DeferrableProvider
{  
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    { 
        $this->app->singleton('qasedak', function ($app) {
            return new ServiceManager($app);
        });

        $this->app->singleton('qasedak.deriver', function ($app) {
            return $app['qasedak']->driver();
        }); 
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['qasedak', 'qasedak.driver'];
    }
}
