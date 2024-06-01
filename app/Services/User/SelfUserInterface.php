<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;

interface SelfUserInterface
{
    public function updateProfile(
        User $user,
        array $fields,
    ) : User;
}
