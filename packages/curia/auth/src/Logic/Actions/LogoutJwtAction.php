<?php

namespace Curia\Auth\Logic\Actions;

class LogoutJwtAction
{
    /**
     * Разлогинивает пользователя.
     *
     * @return boolean
     */
    public function run(): bool
    {
        auth('api')->logout();

        return true;
    }
}