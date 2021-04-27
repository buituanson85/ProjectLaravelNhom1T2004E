<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPayMonneyWaiting extends Mailable
{
    use Queueable, SerializesModels;
    public $histories;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($histories)
    {
        $this->histories = $histories;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Xác nhận rút tiền thành công.')->view('Mail.Send-pay-monney');
    }
}
