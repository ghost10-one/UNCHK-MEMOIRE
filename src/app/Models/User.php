<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Campaign;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['name', 'email', 'password', 'phone', 'role', 'is_active', 'zone_id', 'registration_number', 'grade', 'assignment_date'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, HasRoles, HasApiTokens;

    const ROLE_ADMIN = 'admin';
    const ROLE_DELEGATE = 'delegate';
    const ROLE_MANAGER = 'manager';
    const ROLE_PRO_SANTÉ = 'pro_santé';

    const MAX_FAILED_LOGIN_ATTEMPTS = 5;
    const LOCKOUT_DURATION_MINUTES = 15;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'locked_until' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }

    public function passwordResetTokens()
    {
        return $this->hasMany(PasswordResetTokenExtended::class);
    }

    public function campaigns(): BelongsToMany
    {
        return $this->belongsToMany(Campaign::class, 'campaign_user', 'user_id', 'campaign_id');
    }

    public function isLocked(): bool
    {
        return $this->locked_until && $this->locked_until->isFuture();
    }

    public function incrementFailedAttempts(): void
    {
        $this->failed_login_attempts++;
        
        if ($this->failed_login_attempts >= self::MAX_FAILED_LOGIN_ATTEMPTS) {
            $this->locked_until = now()->addMinutes(self::LOCKOUT_DURATION_MINUTES);
        }
        
        $this->save();
    }

    public function resetFailedAttempts(): void
    {
        $this->failed_login_attempts = 0;
        $this->locked_until = null;
        $this->save();
    }
}
