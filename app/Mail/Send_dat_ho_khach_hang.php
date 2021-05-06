<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Send_dat_ho_khach_hang extends Mailable
{
    use Queueable, SerializesModels;
    public $products;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Gửi Xác nhận đơn hàng')->view('Mail.Send_dat_ho_khach_hang');
    }
}
