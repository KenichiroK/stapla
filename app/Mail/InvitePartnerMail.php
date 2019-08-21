<?php

namespace App\Mail;

use App\CompanyUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;


class InvitePartnerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $company_id;
    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($company_id, $email)
    {
        $this->company_id = $company_id;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $auth = Auth::user();

        return $this->view('emails.invite.invitePartner')
                    ->with([
                        'company_id' => $this->company_id,
                        'email' => $this->email,
                    ]);
    }
}
