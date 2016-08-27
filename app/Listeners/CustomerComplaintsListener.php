<?php

namespace App\Listeners;

use App\Events\SendCustomerComplaints;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class CustomerComplaintsListener
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
     * @param  SendCustomerComplaints  $event
     * @return void
     */
    public function handle(SendCustomerComplaints $event)
    {
        Mail::send('email.complaints', array('first_name'=> $event->req->firstName,'last_name'=> $event->req->lastName, 'phone' => $event->req->phone, 'email'=>$event->req->email, 'subject' => $event->req->subject, 'complaint' => $event->req->message), 
            function($message) use ($event)
            {
            $message->from($event->req->email, $event->req->firstName."".$event->req->lastName);
            $message->to("work@tier5.us", $event->req->firstName)->subject($event->req->subject);
        });
        //dd($event->req);
    }
}
