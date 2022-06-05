<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends ModelUuid implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use HasApiTokens, HasFactory, Notifiable;
    use Authenticatable, Authorizable, CanResetPassword;

    public const TABLE = 'users';

    public const ID_COLUMN = 'id';
    public const NAME_COLUMN = 'name';
    public const EMAIL_COLUMN = 'email';
    public const EMAIL_VERIFIED_AT_COLUMN = 'email_verified_at';
    public const PASSWORD_COLUMN = 'password';
    public const TWO_FACTOR_SECRET_COLUMN = 'two_factor_secret';
    public const TWO_FACTOR_RECOVERY_CODES = 'two_factor_recovery_codes';
    public const TWO_FACTOR_CONFIRMED_AT_COLUMN = 'two_factor_confirmed_at';
    public const REMEMBER_TOKEN_COLUMN = 'remember_me';
    public const CREATED_AT_COLUMN = 'created_at';
    public const UPDATED_AT_COLUMN = 'updated_at';

    protected $table = self::TABLE;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        self::NAME_COLUMN,
        self::EMAIL_COLUMN,
        self::PASSWORD_COLUMN
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        self::PASSWORD_COLUMN,
        self::REMEMBER_TOKEN_COLUMN,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        self::EMAIL_VERIFIED_AT_COLUMN       => 'datetime',
        self::TWO_FACTOR_CONFIRMED_AT_COLUMN => 'datetime',
        self::CREATED_AT_COLUMN              => 'datetime',
        self::UPDATED_AT_COLUMN              => 'datetime',
    ];

    public function getId(): string
    {
        return $this->getAttribute(self::ID_COLUMN);
    }

    public function getName(): string
    {
        return $this->getAttribute(self::NAME_COLUMN);
    }

    public function getEmail(): string
    {
        return $this->getAttribute(self::EMAIL_COLUMN);
    }

    public function getEmailVerifiedAt(): ?Carbon
    {
        return $this->getAttribute(self::EMAIL_VERIFIED_AT_COLUMN);
    }

    public function getPassword(): string
    {
        return $this->getAttribute(self::PASSWORD_COLUMN);
    }

    public function getTwoFactorSecret(): ?string
    {
        return $this->getAttribute(self::TWO_FACTOR_SECRET_COLUMN);
    }

    public function getTwoFactorRecoveryCodes(): ?string
    {
        return $this->getAttribute(self::TWO_FACTOR_RECOVERY_CODES);
    }

    public function getTwoFactorConfirmedAt(): ?Carbon
    {
        return $this->getAttribute(self::TWO_FACTOR_CONFIRMED_AT_COLUMN);
    }

    public function getRememberToken(): ?string
    {
        return $this->getAttribute(self::REMEMBER_TOKEN_COLUMN);
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->getAttribute(self::CREATED_AT_COLUMN);
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->getAttribute(self::UPDATED_AT_COLUMN);
    }
}
