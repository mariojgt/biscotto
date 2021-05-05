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
        $this->loadViewsFrom(__DIR__ . '/views', 'biscotto');

        // Load biscotto routes
        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');
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
    }
}
