<?php

namespace App\Shared\Application\Service;

use App\Shared\Domain\Contract\PasswordServiceInterface;
use App\Shared\Domain\Exception\PasswordException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class PasswordService implements PasswordServiceInterface
{
    public const MIN_PASSWORD_LENGTH = 8;
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function hashPassword(UserInterface|PasswordAuthenticatedUserInterface $user, string $plaintextPassword): string
    {
        if (strlen($plaintextPassword) < self::MIN_PASSWORD_LENGTH) {
            throw PasswordException::invalidLength();
        }
        return $this->passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
    }

    public function isValidPassword(UserInterface $user, string $plaintextPassword): bool
    {
        return $this->passwordHasher->isPasswordValid($user, $plaintextPassword);
    }
}