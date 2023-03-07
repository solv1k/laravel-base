<?php

namespace Curia\Auth\Data\DTO;

use Spatie\LaravelData\Data;

class LoginDTO extends Data
{
    public function __construct(
        public string $email,
        public string $password
    ) {

    }
}