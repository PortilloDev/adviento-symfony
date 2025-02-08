<?php

namespace App\User\Application\Command\CreateUser;

use App\Shared\Domain\Bus\HandlerInterface;
use App\User\Domain\Contract\UserRepositoryInterface;
use App\User\Domain\Entity\User;
use App\User\Domain\Exception\UserAlreadyExistsException;

class CreateUserCommandHandler implements HandlerInterface
{

    public function __construct(
        private UserRepositoryInterface $userRepository
    ) {
    }

    public function __invoke(CreateUserCommand $command): int
    {
        $user = $this->userRepository->findByEmail($command->email);
        if ($user) {
            throw new UserAlreadyExistsException();
        }
        $user = User::create($command->name, $command->email, $command->password);
        $this->userRepository->save($user);

        return $user->getId();
    }
}