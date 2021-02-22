<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ClinicResource;
use App\Http\Resources\RegistrationResource;
use App\Http\Resources\InsuranceResource;
use App\Http\Resources\MedicalResource;
use App\Http\Resources\LetterResource;

class PatientResource extends JsonResource
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
			'name' => $this->name,
			'dob' => $this->dob,
			'gender' => $this->gender,
			'blood' => $this->blood,
			'height' => $this->height,
			'weight' => $this->weight,
			'address' => $this->address,
			'phone' => $this->phone,
			'insurance_number' => $this->insurance_number,
			'clinic' => new ClinicResource($this->whenLoaded('clinic')),
			'insurance' => new InsuranceResource($this->whenLoaded('insurance')),
			'registrations' => RegistrationResource::collection($this->whenLoaded('registrations')),
			'medicals' => MedicalResource::collection($this->whenLoaded('medicals')),
			'letters' => LetterResource::collection($this->whenLoaded('letters')),
		];
	}
}
