<?php

namespace App\Traits\Favorite;

use App\Http\Resources\Airline\AirlineItemResource;
use App\Http\Resources\City\CityItemResource;
use App\Http\Resources\Ticket\TicketItemResource;
use App\Models\Airline;
use App\Models\City;
use App\Models\Ticket;

trait ModelFavoriteTrait
{
    private array $favorites = [
        'Ticket' => Ticket::class,
        'Airline' => Airline::class,
        'City' => City::class,
    ];

    private array $resourceFavorites = [
        Ticket::class => TicketItemResource::class,
        Airline::class => AirlineItemResource::class,
        City::class => CityItemResource::class,
    ];

    private function getInstanceResourceCollection(object $value, string $model)
    {
        $favoriteType = $this->favorites[$model];
        $resourceType = $this->resourceFavorites[$favoriteType];
        return $resourceType::make($value);
    }

}
