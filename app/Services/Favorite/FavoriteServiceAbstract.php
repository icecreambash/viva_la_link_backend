<?php

namespace App\Services\Favorite;

use App\Models\Favorite;
use App\Models\Ticket;
use App\Models\User;
use App\Traits\Favorite\ModelFavoriteTrait;
use Illuminate\Database\Eloquent\Builder;

abstract class FavoriteServiceAbstract implements FavoriteInterface
{
    use ModelFavoriteTrait;

    /**
     * @throws \Throwable
     */
    public function attachItems(User $user, string $model_type, array $model_ids): int
    {

        $model = new $this->favorites[$model_type];

        throw_if(!is_object($model), \RuntimeException::class);

        $items = $model::whereIn('id', $model_ids)->get();

        $items->each(function (object $val) use ($user, $model_type) {
            if($favorite = Favorite::where('favoriteable_type', $model_type)->where('favoriteable_id',$val->id)->first())
            {
                $favorite->delete();
            }else {
                $favorite = new Favorite();

                $favorite->user()->associate($user);
                $favorite->favoriteable()->associate($val);
                $favorite->save();
            }
        });


        return 0;
    }

    public function getFavorites(User $user, string $model,)
    {
        return Favorite::where('user_id',$user->id)->where('favoriteable_type',$model)->get();
    }
}
