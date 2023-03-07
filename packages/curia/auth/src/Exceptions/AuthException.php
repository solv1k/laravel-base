<?php

namespace Curia\Auth\Exceptions;

use Curia\Base\Exceptions\ResponseException;

class AuthException extends ResponseException
{
    public function __construct()
    {
        parent::__construct(
            langKey: 'curia.auth::app.exceptions.unauthenticated',
            code: 401
        );
    }
}