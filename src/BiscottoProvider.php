<?php
namespace Mariojgt\Biscotto;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class BiscottoProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Load biscotto views
        $this->loadViewsFrom(__DIR__.'/views', 'biscotto');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publish();
    }

    public function publish()
    {
        // Publish the npm case we need to do soem developent
        $this->publishes([
            __DIR__.'/../Publish/Npm/' => base_path()
        ]);

        // Publish the resource in case we need to compile
        $this->publishes([
            __DIR__.'/../Publish/Resource/' => resource_path('vendor/Biscotto/')
        ]);

        // Publish the public folder
        $this->publishes([
            __DIR__.'/../Publish/Public/' => public_path('vendor/Biscotto/')
        ]);

        // Publish the public folder
        $this->publishes([
            __DIR__.'/../Publish/Config/' => config_path('')
        ]);
    }
}
