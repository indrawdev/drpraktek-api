<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ClinicResource;

class DrugResource extends JsonResource
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
			'sku' => $this->sku,
			'name' => $this->name,
			'price' => $this->price,
			'client' => new ClinicResource($this->whenLoaded('client')),
		];
	}
}
