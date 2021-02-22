<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Insurance;
use App\Http\Resources\InsuranceResource;

class InsuranceController extends Controller
{
	public function index()
	{
		$insurances = Insurance::all();

		if ($insurances->count() > 0) {
			return InsuranceResource::collection($insurances);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required'
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$insurance = new Insurance();
			$insurance->name = $request->name;
			$insurance->address = $request->address;
			$insurance->slug = $request->name;
			$insurance->save();

			return response()->json(['success' => true, 'data' => $insurance], 201);
		}
	}

	public function show($id)
	{
		$insurance = Insurance::find($id);
		
		if ($insurance) {
			return new InsuranceResource($insurance);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}

	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required'
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$insurance = Insurance::find($id);
			
			if ($insurance) {
				$insurance->name = $request->name;
				$insurance->address = $request->address;
				$insurance->slug = $request->name;
				$insurance->save();
				return response()->json(['success' => true, 'data' => $insurance], 200);
			} else {
				return response()->json(['message' => 'Not Found'], 404);
			}
		}
	}

	public function destroy($id)
	{
		$insurance = Insurance::find($id);

		if ($insurance) {
			$insurance->delete();
			return response()->json(['success' => true, 'data' => $insurance], 200);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}
}
