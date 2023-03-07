<?php

namespace Curia\Base\UI\Api\V1\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Curia\Base\Exceptions\ResponseException;
use Arr;
use Str;

abstract class BaseApiRequest extends FormRequest
{
    /**
     * Возвращает полный ключ ошибки валидации.
     *
     * @return string
     */
    protected function getFullErrorValidationKey(string $fieldKey, Validator $validator): string
    {
        $failedRules = $validator->failed();

        return 'validation.' . Str::lower(array_search(Arr::first($failedRules[$fieldKey]), $failedRules[$fieldKey]) ?: 'none');
    }

    /**
     * Возвращает массив ошибок валидатора с сообщениями и ключами.
     *
     * @return array
     */
    protected function validatorMessagesToArray(Validator $validator): array
    {
        return collect($validator->errors()->toArray())
            ->map(function ($error, $fieldKey) use ($validator) {
                return [
                    'text' => $error[0] ?? '',
                    'key' => $this->getFullErrorValidationKey($fieldKey, $validator)
                ];
            })
            ->toArray();
    }

    /**
     * Метод срабатывает в случае неуспешной валидации данных запроса.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    public function failedValidation(Validator $validator)
    {
        return $this->abort($this->validatorMessagesToArray($validator));
    }

    /**
     * Метод вызывает исключение и прерывает дальнейшие действия.
     *
     * @param string $message
     * @param array $data
     * @param int $code
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    public function abort(array $data = [], int $code = 422)
    {
        throw new ResponseException(
            langKey: 'curia.base::app.validation.global',
            data: $data,
            code: $code
        );
    }
}
