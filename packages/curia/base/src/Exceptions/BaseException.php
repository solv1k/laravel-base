<?php

namespace Curia\Base\Exceptions;

use Exception;
use Throwable;
use Illuminate\Contracts\Support\Arrayable;

class BaseException extends Exception implements Arrayable
{
    public function __construct(
        protected string $langKey,
        protected array $data = [],
        int|string $code = 400,
        ?Throwable $previous = null
    ) {
        parent::__construct(trans($langKey), (int)$code, $previous);
    }

    public function toArray(): array
    {
        return [
            'key' => $this->langKey,
            'text' => $this->message
        ];
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function mergeData(array $newData = [])
    {
        $this->data = array_merge($this->data, $newData);
        return $this;
    }

    public function hasData(): bool
    {
        return !empty($this->data);
    }
}