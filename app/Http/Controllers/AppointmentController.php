<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Appointment;
use App\Http\Resources\AppointmentResource;

class AppointmentController extends Controller
{
	public function index()
	{
		$appointments = Appointment::all();

		if ($appointments->count() > 0) {

		} else {

		}
	}

	public function store(Request $request)
	{
		//
	}

	public function show($id)
	{
		//
	}

	public function edit($id)
	{
		//
	}

	public function update(Request $request, $id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}
}
