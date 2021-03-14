<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ClinicResource;
use App\Http\Resources\RegistrationResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\PatientResource;


class MedicalResource extends JsonResource
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
			'clinic' => new ClinicResource($this->whenLoaded('clinic')),
			'registration' => new RegistrationResource($this->whenLoaded('registration')),
			'user' => new UserResource($this->whenLoaded('user')),
			'patient' => new PatientResource($this->whenLoaded('patient')),
			'anamnesa' => $this->anamnesa,
			'diagnosis' => $this->diagnosis,
			'action' => $this->action,
			'total' => $this->total
		];
	}
}
