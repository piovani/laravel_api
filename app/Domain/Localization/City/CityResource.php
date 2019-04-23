<?php

namespace App\Domain\Localization\City;

use App\Domain\Localization\State\State;
use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'state' => State::findOrFail($this->state_id),
        ];
    }
}
