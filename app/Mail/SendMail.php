<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
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
        if($this->data['status'] == 'invited'){
            return $this->from('dinesh.cypress@gmail.com')->subject('Inviting You For Interview')->view('invite_email_template')->with('data', $this->data);
        }elseif($this->data['status'] == 'waiting'){
            return $this->from('dinesh.cypress@gmail.com')->subject('Regarding Your Applied Job waiting')->view('invite_email_template')->with('data', $this->data);
        }elseif($this->data['status'] == 'selected'){
            return $this->from('dinesh.cypress@gmail.com')->subject('Regarding Your Applied Job selected')->view('invite_email_template')->with('data', $this->data);
        }else{
            return $this->from('dinesh.cypress@gmail.com')->subject('Regarding Your Applied Job rejected')->view('invite_email_template')->with('data', $this->data);
        }
    }
}
