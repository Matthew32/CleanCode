<?php

namespace CleanCode\Contact\Application;

use CleanCode\Contact\Domain\Contact;
use CleanCode\Contact\Infrastructure\Repositories\ContactRepository;

class Create
{
    protected $contactRepository;

    /**
     * @param ContactRepository $contactRepository
     */
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function __invoke(Contact $contact)
    {
        return $this->contactRepository->save($contact);
    }
}
