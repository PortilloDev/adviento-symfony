<?php

namespace App\User\Infrastructure\Symfony\Model\Request;

use Symfony\Component\Validator\Constraints as Assert;
class CreateUserPayload
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Email]
        public string $email,

        #[Assert\NotBlank]
        public string $password,

        #[Assert\NotBlank]
        public string $firstName,

        #[Assert\NotBlank]
        public string $lastName,
    ) {
    }

}