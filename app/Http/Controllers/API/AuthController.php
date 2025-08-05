<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Repositories\Auth\AuthRepositoryInterface;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function register(RegisterRequest $request)
    {

        try {
            $result = $this->authRepository->register($request);

            return response()->json([
                'message' => 'Registration successful',
                'access_token' => $result['token'],
                'token_type'   => 'Bearer',
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function login(LoginRequest $request)
    {
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        try {
            $result = $this->authRepository->login($request);

            return response()->json([
                'message' => 'Login successful',
                'access_token' => $result['token'],
                'token_type'   => 'Bearer',
            ]);
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function me(Request $request)
    {
        try {
            $user = $this->authRepository->me($request);
            return response()->json($user);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function logout(Request $request)
    {
        try {
            $this->authRepository->logout($request);
            return response()->json(['message' => 'Logged out success']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }

    public function refresh(Request $request)
    {
        try {
            $newToken = $this->authRepository->refresh($request);

            return response()->json([
                'message' => 'Token refreshed',
                'access_token' => $newToken,
                'token_type'   => 'Bearer',
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
}
