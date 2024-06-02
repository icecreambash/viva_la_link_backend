<?php

namespace App\Http\Resources\Ticket;

use App\Http\Resources\Airline\AirlineItemResource;
use App\Http\Resources\Category\CategoryItemResource;
use App\Http\Resources\City\CityItemResource;
use App\Http\Resources\Country\CountryItemResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'airline' => AirlineItemResource::make($this->airline),
            'code' => $this->code,
            'flight_time' => $this->flight_time->format('H:i'),
            'start_time' => $this->start_time->format('d.m.Y'),
            'start_city' => CityItemResource::make($this->startCity),
            'end_city' => CityItemResource::make($this->endCity),
            'stops' => $this->count_step,
            'country' => CountryItemResource::make($this->country),
            'category' => CategoryItemResource::make($this->category),
            'start_fly' => $this->start_fly->format('H:i'),
            'end_fly' => $this->end_fly->format('H:i'),
            'price' => $this->price,
        ];
    }
}
