<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Services\AuthenticationService;
use App\Services\PasswordResetService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    protected AuthenticationService $authService;
    protected PasswordResetService $passwordService;

    public function __construct(AuthenticationService $authService, PasswordResetService $passwordService)
    {
        $this->authService = $authService;
        $this->passwordService = $passwordService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $result = $this->authService->register($request->validated());

        if ($result['success']) {
            return response()->json([
                'message' => $result['message'],
                'user' => $result['user'],
            ], 201);
        }

        return response()->json([
            'message' => $result['message'],
        ], 422);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->login(
            $request->email,
            $request->password
        );

        if ($result['success']) {
            return response()->json([
                'message' => $result['message'],
                'user' => $result['user'],
                'token' => $result['token'],
                'token_type' => 'Bearer',
                'expires_in' => 3600,
            ], 200);
        }

        $statusCode = isset($result['locked_until']) ? 423 : 401;

        return response()->json([
            'message' => $result['message'],
            'locked_until' => $result['locked_until'] ?? null,
        ], $statusCode);
    }

    public function logout(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Not authenticated',
            ], 401);
        }

        $result = $this->authService->logout($user);

        return response()->json([
            'message' => $result['message'],
        ], 200);
    }

    public function refresh(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Not authenticated',
            ], 401);
        }

        $result = $this->authService->refreshToken($user);

        if ($result['success']) {
            return response()->json([
                'message' => $result['message'],
                'token' => $result['token'],
                'token_type' => 'Bearer',
                'expires_in' => 3600,
            ], 200);
        }

        return response()->json([
            'message' => $result['message'],
        ], 500);
    }

    public function me(Request $request): JsonResponse
    {
        $user = $request->user();

        if (!$user) {
            return response()->json([
                'message' => 'Not authenticated',
            ], 401);
        }

        return response()->json([
            'user' => $user->only(['id', 'name', 'email', 'role', 'phone', 'is_active']),
        ], 200);
    }

    public function requestPasswordReset(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $result = $this->passwordService->createResetToken($request->email);

        return response()->json([
            'message' => $result['message'],
        ], 200);
    }

    public function resetPassword(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'token' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $result = $this->passwordService->resetPassword(
            $request->token,
            $request->password
        );

        if ($result['success']) {
            return response()->json([
                'message' => $result['message'],
            ], 200);
        }

        return response()->json([
            'message' => $result['message'],
        ], 400);
    }

    public function validateResetToken(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'token' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $isValid = $this->passwordService->validateResetToken($request->token);

        return response()->json([
            'valid' => $isValid,
        ], 200);
    }
}
