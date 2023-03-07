<?php

namespace Curia\Auth\Exceptions;

use Curia\Base\Exceptions\ResponseException;

class InvalidCredentialsException extends ResponseException
{
    public function __construct()
    {
        parent::__construct(
            langKey: 'curia.auth::app.exceptions.invalid-credentials',
            code: 401
        );
    }
}