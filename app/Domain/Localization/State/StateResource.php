<?php

namespace App\Domain\Localization\State;

use App\Domain\Localization\State\State;
use Illuminate\Http\Resources\Json\JsonResource;

class StateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var State $this */

        return [
            'id'       => $this->id,
            'name'     => $this->name,
            'initials' => $this->initials,
        ];
    }
}
