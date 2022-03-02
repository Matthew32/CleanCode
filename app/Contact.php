<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use CleanCode\Contact\Domain\Contact as ContactDomain;

class Contact extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'email', 'phone_number', 'message'];

    public function toDomain()
    {
        $contactDomain = new ContactDomain();
        return $contactDomain->setName($this->name)
            ->setEmail($this->email)
            ->setPhoneNumber($this->phoneNumber)
            ->setMessage($this->message);
    }
}
