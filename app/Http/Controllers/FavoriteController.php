<?php
declare(strict_types=1);
namespace App\Http\Controllers;

use App\Http\Requests\Favorite\FavoriteCreateRequest;
use App\Http\Requests\Favorite\FavoriteGetRequest;
use App\Http\Resources\Favorite\FavoriteItemResource;
use App\Models\Favorite;
use App\Models\Ticket;
use App\Services\Favorite\FavoriteInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function __construct()
    {

    }

    public function getFavorites(FavoriteGetRequest $request, FavoriteInterface $favoriteService)
    {
        return FavoriteItemResource::collection($favoriteService->getFavorites(
            user: auth()->user(),
            model: $request->model,
        ));
    }

    public function toggleFavorite(FavoriteCreateRequest $request, FavoriteInterface $favoriteService): JsonResponse
    {
        $response = $favoriteService->attachItems(
            user: auth()->user(),
            model_type: $request->get('model_type'),
            model_ids: $request->get('model_ids'),
        );

        return response()->json(
            [
                'message' => 'Successfully sync favorites',
                'status' => $response,
            ]
        );
    }
}
