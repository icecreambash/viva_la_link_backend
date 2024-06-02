<?php

namespace App\Http\Resources\Favorite;

use App\Traits\Favorite\ModelFavoriteTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteItemResource extends JsonResource
{

    use ModelFavoriteTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'favoriteable_type' => $this->favoriteable_type,
            'favoriteable' => $this->getInstanceResourceCollection(
                value: $this->favoriteable,
                model: $this->favoriteable_type
            ),
        ];
    }
}
