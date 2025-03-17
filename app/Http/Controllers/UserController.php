<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @throws ValidationException
     */
    public function login(UserRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        event(new Login('sanctum', $user, false));

        return response()->json([
            'token' => $user->createToken('user_login')->plainTextToken,
        ]);
    }

    public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        event(new Logout('sanctum', auth()->user()));

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function getUser(): JsonResponse
    {
        return response()->json(auth()->user());
    }
}
