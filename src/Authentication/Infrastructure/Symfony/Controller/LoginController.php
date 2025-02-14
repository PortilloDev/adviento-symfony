<?php

namespace App\Authentication\Infrastructure\Symfony\Controller;

use App\Shared\Infrastructure\Symfony\Controller\AbstractApiController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class LoginController extends AbstractApiController
{
    #[Route('/api/login', name: 'login', methods: ['POST'])]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['status' => 'This is a api book']);
    }
}