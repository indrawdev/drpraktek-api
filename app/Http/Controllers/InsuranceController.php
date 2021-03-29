<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Insurance;
use App\Http\Resources\InsuranceResource;
use Exception;

class InsuranceController extends Controller
{
	public function index()
	{
		try {
			$insurances = Insurance::all();
			if ($insurances->count() > 0) {
				return InsuranceResource::collection($insurances);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		} catch (Exception $e) {
			return $e;
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

			try {
				$insurance = new Insurance();
				$insurance->name = $request->name;
				$insurance->address = $request->address;
				$insurance->slug = $request->name;

				DB::transaction(function () use ($insurance) {
					$insurance->save();
				});

				return response()->json(['success' => true, 'data' => new InsuranceResource($insurance)], 201);
			} catch (Exception $e) {
				return $e;
			}
		}
	}

	public function show($id)
	{
		try {
			$insurance = Insurance::find($id);
			if ($insurance) {
				return new InsuranceResource($insurance);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		} catch (Exception $e) {
			return $e;
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

			try {
				$insurance = Insurance::find($id);
				if ($insurance) {
					$insurance->name = $request->name;
					$insurance->address = $request->address;
					$insurance->slug = $request->name;

					DB::transaction(function () use ($insurance) {
						$insurance->save();
					});

					return response()->json(['success' => true, 'data' => new InsuranceResource($insurance)], 200);
				} else {
					return response()->json(['error' => 'Not found'], 404);
				}
			} catch (Exception $e) {
				return $e;
			}
		}
	}

	public function destroy($id)
	{
		try {
			$insurance = Insurance::find($id);
			if ($insurance) {
				$insurance->delete();
				return response()->json(['success' => true, 'data' => new InsuranceResource($insurance)], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		} catch (Exception $e) {
			return $e;
		}
	}
}