<?php

namespace App\Domain\Localization\State;

use Illuminate\Http\Resources\Json\JsonResource;

class StateRequest extends JsonResource
{
    public function authorization()
    {
        return true;
    }

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'initials' => $this->initials
        ];
    }
}