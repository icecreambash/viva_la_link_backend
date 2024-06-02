<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\User\UsersListRequest;
use App\Http\Resources\Users\UserResource;
use App\Models\User;
use \Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UsersController extends Controller
{
    public function __construct()
    {

    }

    public function getUserList(UsersListRequest $request): AnonymousResourceCollection
    {

        if(auth()->user()->cannot('viewAny',User::class))
        {
            abort(403);
        }

        return UserResource::collection(User::query()->cursorPaginate($request->integer('_per_page',15)));
    }
}
