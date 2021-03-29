<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\Register;
use App\Http\Resources\RegisterResource;
use App\Mail\RegisterNewed;
use App\Mail\RegisterApproved;
use App\Mail\RegisterRejected;
use Exception;

class RegisterController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth:sanctum', ['except' => ['store']]);
	}

	public function index()
	{
		try {
			$registers = Register::with('user')->get();
			if ($registers->count() > 0) {
				return RegisterResource::collection($registers);
			} else {
				return response()->json(['message' => 'Not Found'], 404);
			}
		} catch (Exception $e) {
			return $e;
		}
	}

	public function store(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|string',
			'clinic' => 'required|string',
			'address' => 'required|string',
			'email' => 'required|email|uniquie',
			'phone' => 'required|string',
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {

			try {
				$register = new Register();
				$register->name = $request->name;
				$register->clinic = $request->clinic;
				$register->address = $request->address;
				$register->email = $request->email;
				$register->phone = $request->phone;

				DB::transaction(function () use ($register) {
					$register->save();
					Mail::to($register->email)->send(new RegisterNewed($register));
				});

				return new RegisterResource($register);
			} catch (Exception $e) {
				return $e;
			}
		}
	}

	public function show($id)
	{
		try {
			$register = Register::find($id);
			if ($register) {
				return new RegisterResource($register);
			} else {
				return response()->json(['message' => 'Not Found'], 404);
			}
		} catch (Exception $e) {
			return $e;
		}
	}

	public function update(Request $request, $id)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|string',
			'clinic' => 'required|string',
			'address' => 'required|string',
			'email' => 'required|email',
			'phone' => 'required|string',
		]);

		if ($validator->fails()) {
			return response()->json(['errors' => $validator->errors()], 400);
		} else {

			try {
				$register = Register::find($id);
				if ($register) {
					$register->name = $request->name;
					$register->clinic = $request->clinic;
					$register->address = $request->address;
					$register->email = $request->email;
					$register->phone = $request->phone;

					DB::transaction(function () use ($register) {
						$register->save();
					});

					return response()->json(['success' => true, 'data' => new RegisterResource($register)], 200);
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
			$register = Register::find($id);
			if ($register) {
				$register->delete();
				return response()->json(['success' => true, 'data' => $register], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		} catch (Exception $e) {
			return $e;
		}
	}

	public function accepted(Request $request)
	{
		try {
			$register = Register::find($request->register_id);
			if ($register) {
				Mail::to($register->email)->send(new RegisterApproved($register));
				return response()->json(['success' => true, 'data' => $register], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		} catch (Exception $e) {
			return $e;
		}
	}

	public function rejected(Request $request)
	{
		try {
			$register = Register::find($request->register_id);
			if ($register) {
				Mail::to($register->email)->send(new RegisterRejected($register));
				return response()->json(['success' => true, 'data' => $register], 200);
			} else {
				return response()->json(['error' => 'Not found'], 404);
			}
		} catch (Exception $e) {
			return $e;
		}
	}
}
