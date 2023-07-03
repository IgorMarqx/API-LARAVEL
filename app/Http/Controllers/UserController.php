<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\SigninRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function signup(CreateUserRequest $request): JsonResponse
    {
        $data = $request->only(['name', 'email', 'password', 'state_id']);

        $user = User::create($data);

        $response = [
            'error' => '',
            'token' => $user->createToken('Register_token')->plainTextToken,
        ];

        return response()->json($response);
    }

    public function signin(SigninRequest $request): JsonResponse
    {
        $data = $request->only(['email', 'password']);

        if (Auth::attempt($data)) {
            $user = Auth::user();
            $response = [
                'error' => '',
                'token' => $user->createToken('Login_token')->plainTextToken,
            ];

            return response()->json($response);
        }

        return response()->json(['error' => 'Usuário ou senha inválidos.']);
    }

    public function me(Request $request): JsonResponse
    {
        $user = Auth::user();

        $response = [
            'name' => $user->name,
            'email' => $user->email,
            'state' => $user->state->name,
            'ads' => $user->advertises,
        ];

        return response()->json($response);
    }
}
