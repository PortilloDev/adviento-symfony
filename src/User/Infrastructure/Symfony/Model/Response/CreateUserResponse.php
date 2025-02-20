<?php

namespace App\User\Infrastructure\Symfony\Model\Response;

class CreateUserResponse implements \JsonSerializable
{
    public function __construct(public string $id)
    {
    }

    public function jsonSerialize(): mixed
    {
        return ['id' => $this->id];
    }
}