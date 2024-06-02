<?php

namespace App\Services\Favorite;

use App\Models\User;

interface FavoriteInterface
{
    public function attachItems(
        User $user,
        string $model_type,
        array $model_ids,
    );

    public function getFavorites(
        User $user,
        string $model,
    );
}
