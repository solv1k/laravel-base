<?php

namespace Curia\Auth\UI\Api\V1\Controllers;

use Curia\Auth\Data\DTO\LoginDTO;
use Curia\Auth\Logic\Actions\LoginJwtAction;
use Curia\Auth\UI\Api\V1\Requests\LoginRequest;
use Curia\Auth\UI\Api\V1\Resources\AuthenticatedUserResource;
use Curia\Base\UI\Api\V1\Controllers\BaseApiController;
use Illuminate\Http\JsonResponse;

class LoginController extends BaseApiController
{
    /**
     * Авторизация пользователя.
     *
     * @param LoginRequest $request
     * @param LoginJwtAction $loginJwtAction
     * @return JsonResponse
     */
    public function index(LoginRequest $request, LoginJwtAction $loginJwtAction): JsonResponse
    {
        /**
         * JWT-данные авторизации.
         * 
         * @var array
         */
        $jwtData = $loginJwtAction->run(LoginDTO::from($request->validated()));

        return $this->success([
            'jwt' => $jwtData,
            'user' => new AuthenticatedUserResource(auth('api')->user())
        ]);
    }
}