<?php

namespace Curia\Download\Exceptions;

use Curia\Base\Exceptions\ResponseException;

class BadDownloadIndexException extends ResponseException
{
    public function __construct()
    {
        parent::__construct(
            langKey: 'curia.download::app.exceptions.bad-download-index'
        );
    }
}