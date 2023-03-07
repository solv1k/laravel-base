<?php

namespace Curia\Auth\UI\Api\V1\Controllers;

use Curia\Auth\Logic\Actions\LogoutJwtAction;
use Curia\Auth\UI\Api\V1\Resources\AuthenticatedUserResource;
use Curia\Base\UI\Api\V1\Controllers\BaseApiController;
use Illuminate\Http\JsonResponse;

class ProfileController extends BaseApiController
{
    /**
     * Профиль авторизованного юзера.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->success(
            new AuthenticatedUserResource(auth('api')->user())
        );
    }

    /**
     * Выход из аккаунта.
     *
     * @param LogoutJwtAction $logoutJwtAction
     * @return JsonResponse
     */
    public function logout(LogoutJwtAction $logoutJwtAction): JsonResponse
    {
        return $this->success([
            'result' => $logoutJwtAction->run()
        ]);
    }
}