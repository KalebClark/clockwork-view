<?php

namespace KalebClark\ClockworkView;

use Illuminate\Support\ServiceProvider;

class ClockworkViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->loadViewsFrom(__DIR__.'/resources/views', 'clockworkview');

        $this->publishes([
            __DIR__.'/public' => public_path('vendor/clockwork-view')
        ], 'public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Register Route
        include __DIR__.'/routes.php';
        $this->app->make('KalebClark\ClockworkView\ClockworkViewController');
    }
    public function provides()
    {

    }
}
