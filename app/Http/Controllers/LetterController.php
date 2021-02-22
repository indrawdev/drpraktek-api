<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Letter;
use App\Http\Resources\LetterResource;
use PDF;

class LetterController extends Controller
{
	public function index()
	{
		$letters = Letter::with(['doctor', 'patient'])->get();

		if ($letters->count() > 0) {
			return LetterResource::collection($letters);
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

	public function show($id)
	{
		$letter = Letter::with(['clinic', 'doctor', 'patient'])->find($id);

		if ($letter) {
			return new LetterResource($letter);
		} else {
			return response()->json(['message' => 'Not Found'], 404);
		}
	}

	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'doctor_id' => 'required',
			'patient_id' => 'required'
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

	public function referral($uuid)
	{
		$letter = Letter::where('uuid', $uuid)->first();
		if ($letter) {
			$pdf = PDF::loadView('prints.letters.referral', ['letter' => $letter]);
			return $pdf->stream();
		} else {
			$pdf = PDF::loadView('prints.letters.referral');
			return $pdf->stream();
		}

	}

	public function health($uuid)
	{
		$letter = Letter::with(['patient', 'doctor'])->where('uuid', $uuid)->first();

		if ($letter) {
			$pdf = PDF::loadView('prints.letters.health', ['letter' => $letter]);
			return $pdf->stream();
		} else {
			$pdf = PDF::loadView('prints.letters.health');
			return $pdf->stream();
		}

	}

	public function sick($uuid)
	{
		$letter = Letter::where('uuid', $uuid)->first();
		if ($letter) {
			$pdf = PDF::loadView('prints.letters.sick', ['letter' => $letter]);
			return $pdf->stream();
		} else {
			$pdf = PDF::loadView('prints.letters.sick');
			return $pdf->stream();
		}
	}

	public function pregnant($uuid)
	{
		$letter = Letter::where('uuid', $uuid)->first();
		if ($letter) {
			$pdf = PDF::loadView('prints.letters.pregnant', ['letter' => $letter]);
			return $pdf->stream();
		} else {
			$pdf = PDF::loadView('prints.letters.pregnant');
			return $pdf->stream();
		}
	}
}
