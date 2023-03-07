<?php

namespace Curia\Auth\Models\User;

use App\Models\User as LaravelUser;
use Curia\Auth\Enums\User\UserTypeEnum;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class User extends LaravelUser implements JWTSubject
{
    use HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'type'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'type' => UserTypeEnum::class
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Юзер админ?
     *
     * @return boolean
     */
    public function isAdmin(): bool
    {
        return $this->type === UserTypeEnum::ADMIN;
    }
}