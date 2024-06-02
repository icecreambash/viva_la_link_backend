<?php

namespace App\Http\Controllers;

use App\Http\Resources\Airline\AirlineItemResource;
use App\Http\Resources\Category\CategoryItemResource;
use App\Http\Resources\City\CityItemResource;
use App\Http\Resources\Country\CountryItemResource;
use App\Http\Resources\Ticket\TicketItemResource;
use App\Models\Airline;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TicketController extends Controller
{
    public function __construct()
    {

    }

    public function getTickets(Request $request) : AnonymousResourceCollection
    {
        return TicketItemResource::collection(Ticket::query()->paginate(20));
    }

    public function getFiltersForTickets(Request $request): JsonResponse
    {
        return response()->json(
            [
                'categories' => CategoryItemResource::collection(Category::all()),
                'countries' => CountryItemResource::collection(Country::all()),
                'cities' => CityItemResource::collection(City::all()),
                'airlines' => AirlineItemResource::collection(Airline::all()),
                'min_start_time' => Ticket::query()->min('start_time'),
                'max_start_time' => Ticket::query()->max('start_time'),
            ]
        );
    }
}
