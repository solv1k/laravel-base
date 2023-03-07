<?php

namespace Curia\Auth\Logic\Actions;

use Curia\Auth\Data\DTO\LoginDTO;
use Curia\Auth\Exceptions\InvalidCredentialsException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginJwtAction
{
    /**
     * Авторизует пользователя и возвращает JWT-данные авторизации.
     *
     * @param LoginDTO $loginDTO
     * @return array
     * @throws InvalidCredentialsException
     */
    public function run(LoginDTO $loginDTO): array
    {
        if (!$token = auth('api')->attempt($loginDTO->toArray())) {
            throw new InvalidCredentialsException;
        }

        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ];
    }
}