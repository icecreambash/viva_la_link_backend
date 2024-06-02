<?php

namespace App\Http\Controllers;

use App\Http\Requests\Trip\SearchTicketTripRequest;
use App\Http\Resources\Ticket\TicketItemResource;
use App\ModelFilters\TicketFilter;
use App\Models\City;
use App\Models\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TripController extends Controller
{
    public function __construct()
    {

    }

    public function getLiquidWays(Request $request): JsonResponse
    {
        return response()->json(
            [
                'data' => City::with(
                    [
                        'ticketsStart',
                        'ticketsEnd'
                    ])
                    ->withCount('ticketsStart')
                    ->withCount('ticketsEnd')
                    ->get()
                    ->makeHidden(
                        [
                            'ticketsStart',
                            'ticketsEnd',
                        ]
                    )
                    ->sortByDesc(fn($item) => $item->tickets_start_count + $item->tickets_end_count)
                    ->values()
            ]
        );
    }

    public function searchTickets(SearchTicketTripRequest $request): AnonymousResourceCollection
    {
        return TicketItemResource::collection(Ticket::filter($request->validated(), TicketFilter::class)->paginate(15));
    }
}
