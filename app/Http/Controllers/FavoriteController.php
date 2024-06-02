<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Resources\Favorite\FavoriteItemResource;
use App\Models\Favorite;
use App\Models\Ticket;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct()
    {

    }

    public function getFavorites()
    {

        $favorite = new Favorite();

        $ticket = Ticket::all()->first();

        $favorite->user()->associate(auth()->user());

        $favorite->favoriteable()->associate($ticket);

        $favorite->save();

        return FavoriteItemResource::collection(Favorite::all());
    }
}
