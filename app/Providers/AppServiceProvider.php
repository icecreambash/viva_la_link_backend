<?php

namespace App\Providers;

use App\Models\User;
use App\Observers\UserObserver;
use App\Services\BatchBridge\BatchBridge;
use App\Services\BatchBridge\BatchBridgeInterface;
use App\Services\User\SelfUserInterface;
use App\Services\User\SelfUserService;
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

        /**
         * Биндим сервис для парсинга данных из excel
         */

        $this->app->bind(BatchBridgeInterface::class,BatchBridge::class);

        $this->app->bind(SelfUserInterface::class,SelfUserService::class);


        /**
         * Региструрием обсер по пользователям
         */

        User::observe(UserObserver::class);
    }
}
