<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
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
        /**
         * Replace the "from" field with your valid sender email address.
         * The "email-template" is the name of the file present inside
         * "resources/views" folder. If you don't have this file, then
         * create it.
         */
        return $this->from("praiseadediji@gmail.com")->view('mail.update')->subject('Schedule changed');
    }
}