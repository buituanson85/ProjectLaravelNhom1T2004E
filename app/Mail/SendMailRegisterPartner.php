<?php

namespace App\Mail;

use App\Models\Backend\Partner;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailRegisterPartner extends Mailable
{
    use Queueable, SerializesModels;
    public $partners;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($partners)
    {
        $this->partners = $partners;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Thông tin đăng kí đối tác của bạn đã được ghi nhận')->view('Mail.send_mail_confirm_partner');
    }
}
