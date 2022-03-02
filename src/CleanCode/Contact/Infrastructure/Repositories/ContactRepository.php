<?php

namespace CleanCode\Contact\Infrastructure\Repositories;

use App\Contact;
use CleanCode\Contact\Domain\Contact as ContactDomain;

class ContactRepository
{
    protected $model;

    /**
     * @param $model
     */
    public function __construct(Contact $model)
    {
        $this->model = $model;
    }

    public function save(ContactDomain $contactDomain): ?ContactDomain
    {
        $contact = $this->model->create([
            'name' => $contactDomain->name(),
            'phone_number' => $contactDomain->phoneNumber(),
            'email' => $contactDomain->email(),
            'message' => $contactDomain->message(),
        ]);
        if (!isset($contact)) {
            return null;
        }
        return $contact->toDomain();
    }

    public function get()
    {
        $results = [];
        $contactsDomain = $this->model->where('updated_at', '=', 'created_at')->get();
        foreach ($contactsDomain as $contact) {
            $results[] = $contact->toDomain();
        }
        return $results;
    }

    public function update(int $contactId, \Carbon\Carbon $updatedAt)
    {
        /**
         * TODO: Contact update.
         */
        return true;
    }
}
