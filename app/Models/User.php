<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $casts = [
    'role' => UserRole::class,
];


    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'auth_key',
        'password_reset_token',
        'verification_token',
        'access_token',
    ];

    protected $hidden = [
        'password',
        'auth_key',
        'password_reset_token',
        'verification_token',
        'access_token',
        'remember_token',
    ];

    // Laravel handles timestamps automatically
    public $timestamps = true;

    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    // -------------------------
    // Relationships
    // -------------------------

    /**
     * Get the courses this student is registered in.
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_registrations', 'student_id', 'course_id');
    }

    /**
     * Get the courses this user teaches (if teacher).
     */
    public function teachingCourses(): HasMany
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    // -------------------------
    // Helper Methods
    // -------------------------

    /**
     * Check if password is correct.
     */
    public function validatePassword(string $password): bool
    {
        return Hash::check($password, $this->password);
    }

    /**
     * Set password hash.
     */
    public function setPassword(string $password): void
    {
        $this->password = Hash::make($password);
    }

    /**
     * Generate a new auth key.
     */
    public function generateAuthKey(): void
    {
        $this->auth_key = Str::random(32);
    }

    /**
     * Generate password reset token.
     */
    public function generatePasswordResetToken(): void
    {
        $this->password_reset_token = Str::random(32) . '_' . time();
    }

    /**
     * Generate email verification token.
     */
    public function generateEmailVerificationToken(): void
    {
        $this->verification_token = Str::random(32) . '_' . time();
    }

    /**
     * Generate access token (for API).
     */
    public function generateAccessToken(): void
    {
        $this->access_token = Str::random(64);
    }

    /**
     * Remove password reset token.
     */
    public function removePasswordResetToken(): void
    {
        $this->password_reset_token = null;
    }

    /**
     * Check if password reset token is valid.
     */
    public static function isPasswordResetTokenValid(string $token): bool
    {
        if (empty($token) || !str_contains($token, '_')) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = config('auth.passwords.users.expire', 60) * 60;

        return $timestamp + $expire >= time();
    }

    /**
     * Find user by access token (API).
     */
    public static function findByAccessToken(string $token): ?self
    {
        return self::where('access_token', $token)
            ->where('status', self::STATUS_ACTIVE)
            ->first();
    }
}
