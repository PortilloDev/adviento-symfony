<?php

namespace App\User\Infrastructure\Persistence\Repository;

use App\Shared\Infrastructure\Doctrine\BaseRepository;
use App\User\Domain\Contract\UserRepositoryInterface;
use App\User\Domain\Entity\User;
use App\User\Domain\Exception\UserNotFoundException;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    protected static function entityClass(): string
    {
        return User::class;
    }

    public function findByEmailOrFail(string $email): ?User
    {
        if (null === $user = $this->objectRepository->findOneBy(['email' => $email])) {
            throw UserNotFoundException::fromEmail($email);
        }
        return $user;
    }

    public function save(User $user): void
    {
        $this->saveEntity($user);
    }

    public function remove(User $user): void
    {
        $this->removeEntity($user);
    }

}