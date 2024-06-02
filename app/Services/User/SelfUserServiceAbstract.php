<?php

declare(strict_types=1);

namespace App\Services\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

abstract class SelfUserServiceAbstract implements SelfUserInterface
{
    public function updateProfile(User $user, array $fields): User
    {

        $collectionUpdatable = collect();

        if (
            array_key_exists('email', $fields) &&
            $user->email !== $fields['email'] &&
            !User::where('id', '!=', $user->id)->where('email', $fields['email'])->exists()
        ) {
            $collectionUpdatable->push(
                [
                    'email' => $fields['email'],
                ]
            );
        }

        if (
            array_key_exists('current_password', $fields) &&
            array_key_exists('password', $fields) &&
            Hash::check($fields['current_password'],$user->password)
        ) {
            $collectionUpdatable->push(
                [
                    'password' => Hash::make($fields['password'])
                ]
            );
        }

        if(array_key_exists('name',$fields))
        {
            $collectionUpdatable->push(
                [
                    'name' => $fields['name'],
                ]
            );
        }


        return tap($user)->update(
            $collectionUpdatable->flatten()->toArray()
        );
    }
}
