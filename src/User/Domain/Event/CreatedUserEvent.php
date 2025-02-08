<?php

namespace App\User\Domain\Event;

class CreatedUserEvent
{
    public function __construct(public string $email)
    {
    }

}