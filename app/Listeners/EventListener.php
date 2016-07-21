<?php

namespace App\Listeners;

use App\Events\SomeEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class EventListener
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
     * @param  SomeEvent  $event
     * @return void
     */
    public function handle(SomeEvent $event)
    {
        $request = $event->request;
        Mail::send('pages.sendEmail', array('name'=>$request->name,'email'=>$request->email,'password'=>$request->password), 
        function($message) use($request)
        {
            $message->from('work@tier5.us');
            $message->to($request->email, $request->name)->subject('U-rang Details');
        });
    }
}
