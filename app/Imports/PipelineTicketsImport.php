<?php

namespace App\Imports;

use App\Models\Airline;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Ticket;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PipelineTicketsImport implements WithMultipleSheets
{
    public function sheets(): array
    {

        $credentials = (object)[
            'cities' => City::all(),
            'countries' => Country::all(),
            'categories' => Category::all(),
            'airlines' => Airline::all(),
        ];


        return [
            'business' => new AirTicketsImport(
                titleName: 'business',
                credentials: $credentials,
            ),
            'economy' => new AirTicketsImport(
                titleName: 'economy',
                credentials: $credentials,
            ),
        ];
    }
}
