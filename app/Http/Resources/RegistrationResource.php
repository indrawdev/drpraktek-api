<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ClinicResource;
use App\Http\Resources\PatientResource;
use App\Http\Resources\UserResource;

class RegistrationResource extends JsonResource
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
			'number' => $this->number,
			'registered_at' => $this->registered_at,
			'clinic' => new ClinicResource($this->whenLoaded('clinic')),
			'patient' => new PatientResource($this->whenLoaded('patient')),
			'user' => new UserResource($this->whenLoaded('user'))
		];
	}
}
