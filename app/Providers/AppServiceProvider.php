<?php

namespace App\Providers;

use App\Models\Airline;
use App\Models\City;
use App\Models\Country;
use App\Models\Ticket;
use App\Models\User;
use App\Observers\UserObserver;
use App\Services\BatchBridge\BatchBridge;
use App\Services\BatchBridge\BatchBridgeInterface;
use App\Services\Favorite\FavoriteInterface;
use App\Services\Favorite\FavoriteService;
use App\Services\User\SelfUserInterface;
use App\Services\User\SelfUserService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
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

        $this->app->bind(FavoriteInterface::class,FavoriteService::class);


        /**
         * Региструрием обсер по пользователям
         */

        User::observe(UserObserver::class);


        Relation::morphMap(
            [
                'Ticket' => Ticket::class,
                'Airline' => Airline::class,
                'Country' => Country::class,
                'City' => City::class,
                'User' => User::class,
            ]
        );
    }
}
