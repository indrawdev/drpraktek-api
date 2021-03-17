<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ClinicResource;
use App\Http\Resources\PatientResource;

class AppointmentResource extends JsonResource
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
			'appointment_at' => $this->appointment_at,
			'clinic' => new ClinicResource($this->whenLoaded('clinic')),
			'patient' => new PatientResource($this->whenLoaded('patient')),
		];
	}
}
