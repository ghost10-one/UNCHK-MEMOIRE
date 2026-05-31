<?php

namespace App\Services;

use App\Models\User;
use App\Models\PasswordResetTokenExtended;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PasswordResetService
{
    public function createResetToken(string $email): array
    {
        try {
            $user = User::where('email', $email)->first();

            if (!$user) {
                return [
                    'success' => true,
                    'message' => 'If an account exists, a password reset link has been sent',
                ];
            }

            $user->passwordResetTokens()->where('used', false)->update(['used' => true]);

            $token = PasswordResetTokenExtended::generateToken();

            PasswordResetTokenExtended::create([
                'user_id' => $user->id,
                'token' => $token,
                'expires_at' => now()->addMinutes(60),
            ]);

            app(AuthenticationService::class)->auditLog(
                $user->id,
                'password_reset_requested',
                'Password reset token generated',
                request()->ip()
            );

            return [
                'success' => true,
                'token' => $token,
                'message' => 'Password reset token created',
            ];
        } catch (\Exception $e) {
            Log::error('Password reset token creation failed', ['error' => $e->getMessage()]);
            return [
                'success' => false,
                'message' => 'Failed to create reset token',
            ];
        }
    }

    public function resetPassword(string $token, string $password): array
    {
        try {
            $resetToken = PasswordResetTokenExtended::where('token', $token)->first();

            if (!$resetToken || !$resetToken->isValid()) {
                return [
                    'success' => false,
                    'message' => 'Invalid or expired reset token',
                ];
            }

            $user = $resetToken->user;
            $user->update(['password' => Hash::make($password)]);
            $resetToken->update(['used' => true]);

            app(AuthenticationService::class)->auditLog(
                $user->id,
                'password_reset_completed',
                'Password has been reset',
                request()->ip()
            );

            return [
                'success' => true,
                'message' => 'Password reset successfully',
            ];
        } catch (\Exception $e) {
            Log::error('Password reset failed', ['error' => $e->getMessage()]);
            return [
                'success' => false,
                'message' => 'Password reset failed',
            ];
        }
    }

    public function validateResetToken(string $token): bool
    {
        $resetToken = PasswordResetTokenExtended::where('token', $token)->first();
        return $resetToken && $resetToken->isValid();
    }
}
