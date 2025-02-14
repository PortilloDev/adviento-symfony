<?php

namespace App\User\Domain\Contract;

use App\User\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function findByEmailOrFail(string $email): ?User;
    public function save(User $user): void;
    public function remove(User $user): void;

}