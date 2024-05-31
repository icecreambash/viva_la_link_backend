<?php

namespace App\Providers;

use App\Services\BatchBridge\BatchBridge;
use App\Services\BatchBridge\BatchBridgeInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(BatchBridgeInterface::class,BatchBridge::class);
    }
}
