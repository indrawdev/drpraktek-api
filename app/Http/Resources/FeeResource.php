<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ClinicResource;

class FeeResource extends JsonResource
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
					'id' => $this->id,
					'name' => $this->name,
					'price' => $this->price,
					'clinic' => new ClinicResource($this->whenLoaded('clinic'))
				];
    }
}
