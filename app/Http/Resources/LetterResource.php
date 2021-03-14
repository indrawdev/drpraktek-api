<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ClinicResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\PatientResource;

class LetterResource extends JsonResource
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
			'client' => new ClinicResource($this->whenLoaded('client')),
			'user' => new UserResource($this->whenLoaded('user')),
			'patient' => new PatientResource($this->whenLoaded('patient'))
		];
	}
}
