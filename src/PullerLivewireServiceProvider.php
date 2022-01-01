<?php

namespace Bfg\PullerLivewire;

use Bfg\Puller\Controllers\PullerController;
use Illuminate\Support\ServiceProvider;
use Livewire\Controllers\HttpConnectionHandler;
use Livewire\LivewireManager;

class PullerLivewireServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        \Puller::registerChannelInterface(LivewireTaskChannel::class);

        if (class_exists(LivewireManager::class)) {
            $this->app->extend(HttpConnectionHandler::class, function () {
                return app(PullerLivewireController::class);
            });
        }

        $this->publishes([
            __DIR__ . '/../assets' => public_path('vendor/puller-livewire')
        ], 'puller-livewire-assets');

        $this->publishes([
            __DIR__ . '/../assets' => public_path('vendor/puller-livewire')
        ], 'laravel-assets');
    }
}
