<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Http\Resources\Users\UserResource;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller implements HasMiddleware
{

    public static function middleware() : array
    {
        return [
            new Middleware(
                middleware: 'auth:sanctum',
                except: [
                    'login',
                    'register'
                ]
            )
        ];
    }

    /**
     * @throws \Throwable
     */
    public function login(LoginUserRequest $request)
    {
        $user = User::where('email', $request->email)->first();


        throw_if(!$user instanceof User || !Hash::check($request->password, $user->password), ValidationException::withMessages(
            [
                'message' => 'Login or password is not correct'
            ]
        ));

        return response()->json(
            [
                'message' => 'Login successfully',
                '_token' => $user->createToken('*')->plainTextToken,
            ],
            201
        );
    }

    public function register(RegisterUserRequest $request)
    {
        $body = $request->only(
            [
                'name',
                'email',
                'password'
            ]
        );

        /**
         * В 11-м Ларавеле теперь автоматически хешируется пароль =)
         */

        $user = User::create(
            $body
        );


        return response()->json(
            [
                'message' => 'Successfully created user!',
                '_token' => $user->createToken('*')->plainTextToken
            ],
            201
        );
    }

    public function getMe(Request $request)
    {
        return UserResource::make(auth()->user());
    }


}
