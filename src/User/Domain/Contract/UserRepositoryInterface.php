<?php

namespace App\User\Domain\Contract;

use App\User\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;
    public function save(User $user): void;

}