<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->data;
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->view('mail', compact('data'))
            ->subject('[Mã Xác Thực] đăng nhập hệ thống ' . $data['page'] . ' của ' . $data['name'] . ' lúc ' . $data['time']);
    }
}
