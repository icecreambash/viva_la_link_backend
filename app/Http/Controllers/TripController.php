<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
}
