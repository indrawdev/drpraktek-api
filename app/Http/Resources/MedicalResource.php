<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ClinicResource;
use App\Http\Resources\DoctorResource;
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
			'anamnesa' => $this->anamnesa,
			'clinic' => new ClinicResource($this->whenLoaded('clinic')),
			'doctor' => new DoctorResource($this->whenLoaded('doctor')),
			'patient' => new PatientResource($this->whenLoaded('patient')),
		];
	}
}
