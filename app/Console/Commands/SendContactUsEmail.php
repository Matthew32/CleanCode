<?php

namespace App\Console\Commands;

use CleanCode\CleanCode\Contact\Application\Get;
use CleanCode\CleanCode\Contact\Application\SendEmail;
use CleanCode\CleanCode\Contact\Application\Update;
use Illuminate\Console\Command;

class SendContactUsEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-contact-us';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send contact us alert email.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Update $contactUpdateUseCase, Get $contactGetUseCase, SendEmail $contactSendContactUsEmailUseCase)
    {
        try {
            $contacts = $contactGetUseCase();
            foreach ($contacts as $contact) {
                $contactSendContactUsEmailUseCase($contact);
                $newUpdatedDate = Carbon::now();
                $contactUpdateUseCase($contact->id(), $newUpdatedDate);
            }
        } catch (\Exception $e) {
            \Log::error($e);
        }
        return 0;
    }
}
