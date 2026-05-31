<?php

namespace App\Services;

use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthenticationService
{
    public function register(array $data): array
    {
        try {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone' => $data['phone'] ?? null,
                'role' => $data['role'] ?? User::ROLE_DELEGATE,
                'is_active' => true,
            ]);

            $this->auditLog($user->id, 'user_registered', 'User registration completed', request()->ip());

            return [
                'success' => true,
                'user' => $user,
                'message' => 'User registered successfully',
            ];
        } catch (\Exception $e) {
            Log::error('User registration failed', ['error' => $e->getMessage()]);
            return [
                'success' => false,
                'message' => 'Registration failed',
            ];
        }
    }

    public function login(string $email, string $password): array
    {
        $user = User::where('email', $email)->first();

        if (!$user || !Hash::check($password, $user->password)) {
            if ($user) {
                $user->incrementFailedAttempts();
                $this->auditLog($user->id, 'failed_login', 'Failed login attempt', request()->ip());
            }
            return [
                'success' => false,
                'message' => 'Invalid credentials',
            ];
        }

        if ($user->isLocked()) {
            $this->auditLog($user->id, 'login_blocked', 'Login attempt while account locked', request()->ip());
            return [
                'success' => false,
                'message' => 'Account is temporarily locked. Please try again later.',
                'locked_until' => $user->locked_until,
            ];
        }

        if (!$user->is_active) {
            $this->auditLog($user->id, 'inactive_login_attempt', 'Login attempt on inactive account', request()->ip());
            return [
                'success' => false,
                'message' => 'This account is inactive',
            ];
        }

        $user->resetFailedAttempts();
        $token = $user->createToken('auth_token', ['*'], now()->addMinutes(60))->plainTextToken;

        $this->auditLog($user->id, 'login_success', 'User logged in successfully', request()->ip());

        return [
            'success' => true,
            'user' => $user,
            'token' => $token,
            'message' => 'Login successful',
        ];
    }

    public function logout(User $user): array
    {
        try {
            $user->tokens()->delete();
            $this->auditLog($user->id, 'logout', 'User logged out', request()->ip());

            return [
                'success' => true,
                'message' => 'Logged out successfully',
            ];
        } catch (\Exception $e) {
            Log::error('Logout failed', ['error' => $e->getMessage()]);
            return [
                'success' => false,
                'message' => 'Logout failed',
            ];
        }
    }

    public function refreshToken(User $user): array
    {
        try {
            $user->tokens()->delete();
            $token = $user->createToken('auth_token', ['*'], now()->addMinutes(60))->plainTextToken;

            $this->auditLog($user->id, 'token_refresh', 'Auth token refreshed', request()->ip());

            return [
                'success' => true,
                'token' => $token,
                'message' => 'Token refreshed successfully',
            ];
        } catch (\Exception $e) {
            Log::error('Token refresh failed', ['error' => $e->getMessage()]);
            return [
                'success' => false,
                'message' => 'Token refresh failed',
            ];
        }
    }

    public function auditLog(
        ?int $userId,
        string $action,
        string $description = null,
        string $ipAddress = null,
        array $metadata = null
    ): void {
        try {
            AuditLog::create([
                'user_id' => $userId,
                'action' => $action,
                'description' => $description,
                'ip_address' => $ipAddress ?? request()->ip(),
                'user_agent' => request()->userAgent(),
                'metadata' => $metadata,
            ]);
        } catch (\Exception $e) {
            Log::error('Audit logging failed', ['error' => $e->getMessage()]);
        }
    }
}
