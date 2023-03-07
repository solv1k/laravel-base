<?php

namespace Curia\Auth\UI\Api\V1\Requests;

use Curia\Base\UI\Api\V1\Requests\BaseApiRequest;

class LoginRequest extends BaseApiRequest
{
    public function rules()
    {
        return [
            'email' => ['required', 'email'],
            'password' => ['required']
        ];
    }
}