<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
			'insurance_number' => $this->insurance_number
		];
	}
}
