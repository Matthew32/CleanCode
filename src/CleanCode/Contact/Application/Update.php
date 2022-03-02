<?php

namespace CleanCode\CleanCode\Contact\Application;

use Carbon\Carbon;
use CleanCode\Contact\Infrastructure\Repositories\ContactRepository;

class Update
{
    public $contactRepository;

    /**
     * @param $contactRepository
     */
    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function __invoke(int $id, Carbon $updatedAt)
    {
        return $this->contactRepository->update($id, $updatedAt);
    }
}
