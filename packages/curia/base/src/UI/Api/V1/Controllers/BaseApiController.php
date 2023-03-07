<?php

namespace Curia\Base\UI\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BaseApiController extends Controller
{
    /**
     * Метод отправки успешного ответа.
     *
     * @param \ArrayAccess|array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function success(\ArrayAccess|array $data = [])
    {
        if ($data instanceof AnonymousResourceCollection) {
            $data = $data->response()->getData(true);
            return response()->json(array_merge(['success' => true], $data));
        }

        return response()->json(['success' => true] + compact('data'));
    }
}