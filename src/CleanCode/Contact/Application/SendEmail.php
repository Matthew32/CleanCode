<?php

namespace CleanCode\CleanCode\Contact\Application;

use CleanCode\Contact\Domain\Contact;
use Illuminate\Support\Facades\Mail;

class SendEmail
{
    public function __invoke(Contact $contact)
    {
        /**
         * TODO: Send Contact Message.
         */
        $success = Mail::view('contact.alert')
            ->to('admin@motocard.com')
            ->with($contact)
            ->send();
        if(!$success){
            /**
             * TODO: Make custom exception.
             */
            throw  new \Exception();
        }
        return true;
    }
}
