<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateEmailPartner extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $limit)
    {
        $this->token = $token;
        $this->limit = $limit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.update_email')
                    ->subject("[impro] メールアドレス変更のお手続き")
                    ->with([
                    'url' => env('APP_URL')."/partner/setting/profile/email/update?token=$this->token",
                    'limit' => $this->limit
                ]);
    }
}
