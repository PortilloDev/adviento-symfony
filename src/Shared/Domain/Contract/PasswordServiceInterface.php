<?php

namespace App\Shared\Domain\Contract;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

interface PasswordServiceInterface
{
    public function hashPassword(UserInterface|PasswordAuthenticatedUserInterface $user, string $plaintextPassword): string;

    public function isValidPassword(UserInterface $user, string $plaintextPassword): bool;

}