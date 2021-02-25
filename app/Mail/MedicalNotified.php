<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Medical;

class MedicalNotified extends Mailable implements ShouldQueue
{
	use Queueable, SerializesModels;

	/**
	 * The order instance.
	 *
	 * @var \App\Models\Medical
	 */
	public $medical;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(Medical $medical)
	{
		$this->medical = $medical;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->markdown('emails.notifications.medical');
	}
}
