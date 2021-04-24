<?php

namespace App\Jobs;

use App\Mail\SendMailRegisterPartner;
use App\Models\Backend\Partner;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendRegisterPartnerEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $partners;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Partner $partners)
    {
        $this->partners = $partners;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        sleep(10);

        echo 'Start send email';
        $email = new SendMailRegisterPartner($this->partners);
        Mail::to($this->partners->email)->send($email);

        echo 'End send email';
    }
}
