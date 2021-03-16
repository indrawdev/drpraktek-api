<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
	use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'username',
		'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token'
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function setUsernameAttribute($value)
	{
		$this->attributes['username'] = Str::upper($value);
	}

	public function roles()
	{
		return $this->belongsToMany('App\Models\Role')->using('App\Models\RoleUser');
	}

	public function clinics()
	{
		return $this->belongsToMany('App\Models\Clinic')->using('App\Models\ClinicUser');
	}

	public function profile()
	{
		return $this->hasOne('App\Models\Profile');
	}
}
