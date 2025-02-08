<?php

namespace App\User\Infrastructure\Symfony\Controller;

use App\Shared\Infrastructure\Symfony\Controller\AbstractApiController;
use App\User\Application\Command\CreateUser\CreateUserCommand;
use App\User\Infrastructure\Symfony\Model\Response\CreateUserResponse;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class UserCreateController extends AbstractApiController
{
    #[Route('/api/v1/users', name: 'create_users', methods: ['POST'])]
    public function __invoke(Request $request): JsonResponse
    {
        $content = $request->toArray();
        $email = $content['email'];
        $password = $content['password'];
        $name = $content['name'];

       $userId = $this->dispatch(new CreateUserCommand($name, $email, $password));

        return $this->success(new CreateUserResponse($userId), 201);
    }

}