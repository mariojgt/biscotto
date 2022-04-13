<?php

namespace Mariojgt\Biscotto;

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
        $this->loadViewsFrom(__DIR__ . '/views', 'biscotto');
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
        // Publish the public folder
        $this->publishes([
            __DIR__ . '/../Publish/Config/' => config_path('')
        ]);
        // Publish the lang folder
        $this->publishes([
            __DIR__ . '/../Publish/Lang/' => base_path('lang')
        ]);
    }
}
