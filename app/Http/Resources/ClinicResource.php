<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\PatientResource;

class ClinicResource extends JsonResource
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
			'slug' => $this->slug,
			'address' => $this->address,
			'phone' => $this->phone,
			'email' => $this->email,
			'logo' => $this->logo,
			'user' => new UserResource($this->whenLoaded('user')),
		];
	}
}
