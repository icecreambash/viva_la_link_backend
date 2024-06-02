<?php

namespace App\Http\Controllers;

use App\Http\Resources\Airline\AirlineItemResource;
use App\Http\Resources\Category\CategoryItemResource;
use App\Http\Resources\City\CityItemResource;
use App\Http\Resources\Country\CountryItemResource;
use App\Models\Airline;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function __construct()
    {

    }

    public function getTickets(Request $request)
    {
        return Ticket::all();
    }

    public function getFiltersForTickets(Request $request): JsonResponse
    {
        return response()->json(
            [
                'categories' => CategoryItemResource::collection(Category::all()),
                'countries' => CountryItemResource::collection(Country::all()),
                'cities' => CityItemResource::collection(City::all()),
                'airlines' => AirlineItemResource::collection(Airline::all()),
            ]
        );
    }
}
