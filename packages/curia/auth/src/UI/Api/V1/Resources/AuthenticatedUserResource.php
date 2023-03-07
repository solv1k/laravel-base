<?php

namespace Curia\Auth\UI\Api\V1\Resources;

use Curia\Base\Enums\Values\ValueWithLabel;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthenticatedUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'type' => ValueWithLabel::toArray($this->type)
        ];
    }
}
