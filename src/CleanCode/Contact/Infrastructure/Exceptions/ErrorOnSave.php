<?php

namespace CleanCode\CleanCode\Contact\Infrastructure\Exceptions;

class ErrorOnSave extends \Exception
{

    public function __construct($message = 'error_on_save')
    {
        parent::__construct($message);
    }
}
