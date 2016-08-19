<?php

namespace App\Listeners;

use App\Events\SendEmailOnSignUp;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendEmailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendEmailOnSignUp  $event
     * @return void
     */
    public function handle(SendEmailOnSignUp $event)
    {
        Mail::send('email.confirmation', array('email'=>$event->req->email), 
            function($message) use ($event)
            {
            $message->from("admin@u-rang.com");
            $message->to($event->req->email, $event->req->name)->subject('confirmation for signup');
            });
    }
}
