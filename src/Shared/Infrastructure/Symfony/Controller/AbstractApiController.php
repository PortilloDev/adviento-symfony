<?php

namespace App\Shared\Infrastructure\Symfony\Controller;

use App\Shared\Infrastructure\Symfony\Messenger\MessageBusHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class AbstractApiController extends AbstractController
{
    public function __construct(
        private MessageBusHelper $busHelper
    ) {
    }

    public function dispatch(object $message): mixed
    {
        return $this->busHelper->dispatchAndGetResult($message);
    }
    protected function success(mixed $data = null, int $status = 200): JsonResponse
    {
        return new JsonResponse($data, $status);
    }

    protected function badRequest(string $message, ?array $errors = null, int $status = 400): JsonResponse
    {
        return new JsonResponse(['message' => $message, 'errors' => $errors], $status);
    }

}