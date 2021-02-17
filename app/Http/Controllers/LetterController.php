<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Letter;
use Illuminate\Support\Str;
use PDF;

class LetterController extends Controller
{
	public function index()
	{
		$letters = Letter::all();

		if ($letters->count() > 0) {
			return response()->json(['data' => $letters], 200);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}
	
	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'clinic_id' => 'required',
			'doctor_id' => 'required',
			'patient_id' => 'required'
		]);

		if ($validator->fails()) { 
			return response()->json(['errors' => $validator->errors()], 400);
		} else {
			$letter = new Letter();
			$letter->clinic_id = $request->clinic_id;
			$letter->doctor_id = $request->doctor_id;
			$letter->patient_id = $request->patient_id;
			$letter->uuid = (string) Str::uuid();
			$letter->save();

			return response()->json(['success' => true, 'data' => $letter], 201);
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
			$letter = Letter::find($id);

			if ($letter) {
				return response()->json(['success' => true, 'data' => $letter], 200);
			} else {
				return response()->json(['message' => 'Not Found'], 404);
			}
		}
	}

	public function destroy($id)
	{
		$letter = Letter::find($id);

		if ($letter) {
			$letter->delete();
			return response()->json(['success' => true, 'data' => $letter], 200);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}

	public function referral()
	{
		$pdf = PDF::loadView('prints.letters.referral');
		return $pdf->stream();
	}

	public function health()
	{
		$pdf = PDF::loadView('prints.letters.health');
		return $pdf->stream();
	}

	public function sick()
	{
		$pdf = PDF::loadView('prints.letters.sick');
		return $pdf->stream();
	}

	public function pregnant()
	{
		$pdf = PDF::loadView('prints.letters.pregnant');
		return $pdf->stream();
	}
}
