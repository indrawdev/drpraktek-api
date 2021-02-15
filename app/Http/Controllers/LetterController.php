<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LetterController extends Controller
{
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
