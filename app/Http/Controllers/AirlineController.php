<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Resources\Airline\AirlineItemResource;
use App\Models\Airline;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class AirlineController extends Controller
{
    public function __construct()
    {

    }

    public function getAirlines() : AnonymousResourceCollection
    {
        return AirlineItemResource::collection(Airline::query()->cursorPaginate(15));
    }
}
