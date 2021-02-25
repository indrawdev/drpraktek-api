<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Registration;

class RegistrationNotified extends Mailable implements ShouldQueue
{
	use Queueable, SerializesModels;
	
	/**
	 * The order instance.
	 *
	 * @var \App\Models\Registration
	 */
	protected $registration;


	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct(Registration $registration)
	{
		$this->registration = $registration;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		return $this->markdown('emails.notifications.registration');
	}
}
