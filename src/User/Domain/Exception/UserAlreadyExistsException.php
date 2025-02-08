<?php

namespace App\User\Domain\Exception;

class UserAlreadyExistsException extends \Exception
{
    public function __construct()
    {
        parent::__construct('User already exists');
    }
}