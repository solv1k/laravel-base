<?php

namespace Curia\Auth\Logic\Actions;

use Curia\Auth\Exceptions\AuthException;
use Curia\Auth\Exceptions\RefreshJwtException;
use Tymon\JWTAuth\Facades\JWTAuth;

class RefreshJwtAction
{
    /**
     * Возвращает обновлённый JWT-токен юзера.
     *
     * @return array
     * @throws AuthException
     * @throws RefreshJwtException
     */
    public function run(): array
    {
        if (!auth('api')->user()) {
            throw new AuthException;
        }

        if (!$token = auth('api')->refresh()) {
            throw new RefreshJwtException;
        }

        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ];
    }
}