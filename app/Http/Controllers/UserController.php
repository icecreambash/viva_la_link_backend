<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginUserRequest;
use App\Http\Requests\User\PatchUserRequest;
use App\Http\Requests\User\RegisterUserRequest;
use App\Http\Resources\Users\UserResource;
use App\Models\User;
use App\Services\User\SelfUserInterface;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ClosureValidationRule;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\JsonResponse as JResponse;

class UserController extends Controller implements HasMiddleware
{

    public static function middleware(): array
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
    public function login(LoginUserRequest $request): JResponse
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
                'user' => UserResource::make($user),
            ],
            201
        );
    }

    public function register(RegisterUserRequest $request): JResponse
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
                '_token' => $user->createToken('*')->plainTextToken,
                'user' => UserResource::make($user),
            ],
            201
        );
    }

    public function getMe(): UserResource
    {
        return UserResource::make(auth()->user());
    }

    /**
     * @throws \Throwable
     */
    public function patchMe(PatchUserRequest $request, SelfUserInterface $selfUserService)
    {
        return response()->json(
            [
                'message' => 'Successfully updated user!',
                'user' => UserResource::make(
                    $selfUserService->updateProfile(
                        user: auth()->user(),
                        fields: $request->only(
                            [
                                'email',
                                'name',
                                'current_password',
                                'password',
                            ]
                        ),
                    )
                )
            ]
        );
    }


}
