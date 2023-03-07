<?php

namespace Curia\Auth\Exceptions;

use Curia\Base\Exceptions\ResponseException;

class RefreshJwtException extends ResponseException
{
    public function __construct()
    {
        parent::__construct(
            langKey: 'curia.auth::app.exceptions.refresh-jwt',
            code: 400
        );
    }
}