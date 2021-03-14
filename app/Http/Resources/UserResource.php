<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProfileResource;
use App\Http\Resources\RoleResource;
use App\Http\Resources\ClinicResource;

class UserResource extends JsonResource
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
			'username' => $this->username,
			'roles' => RoleResource::collection($this->whenLoaded('roles')),
			'profile' => new ProfileResource($this->whenLoaded('profile')),
			'clinics' => ClinicResource::collection($this->whenLoaded('clinics')),
		];
	}
}
