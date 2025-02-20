<?php

namespace App\User\Application\Command\CreateUser;

use App\Shared\Domain\Bus\HandlerInterface;
use App\Shared\Domain\Contract\PasswordServiceInterface;
use App\User\Domain\Contract\UserRepositoryInterface;
use App\User\Domain\Entity\User;
use App\User\Domain\Exception\UserAlreadyExistsException;
use Psr\Log\LoggerInterface;

class CreateUserCommandHandler implements HandlerInterface
{

    public function __construct(
        private UserRepositoryInterface $userRepository,
        private PasswordServiceInterface $passwordService,
        private LoggerInterface $logger,
    ) {
    }

    public function __invoke(CreateUserCommand $command): string
    {
        $user = User::create($command->name, $command->email);
        $passwordHash = $this->passwordService->hashPassword($user, $command->password);
        $user->setPassword($passwordHash);

        try {
            $this->userRepository->save($user);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw UserAlreadyExistsException::fromEmail($command->email);
        }

        return $user->getId();
    }
}