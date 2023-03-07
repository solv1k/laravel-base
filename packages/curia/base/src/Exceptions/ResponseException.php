<?php

namespace Curia\Base\Exceptions;

use Illuminate\Http\JsonResponse;

class ResponseException extends BaseException
{
    public function toJsonResponse(): JsonResponse
    {
        $data = [
            'success' => false,
            'message' => $this->toArray(),
            'data' => $this->getData(),
            'code' => $this->getCode()
        ];

        if (config('curia.base.exceptions.trace')) {
            $data['trace'] = $this->getTrace();
        }

        return response()->json(
            data: $data,
            status: $this->code
        );
    }

    public function render()
    {
        return $this->toJsonResponse();
    }
}