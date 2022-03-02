<?php

namespace CleanCode\CleanCode\Contact\Application;

use CleanCode\Contact\Infrastructure\Repositories\ContactRepository;

class Get
{
protected $contactRepository;

    /**
     * @param $contactRepository
     */
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }
    public function __invoke(){
        return $this->contactRepository->get();
    }
}
