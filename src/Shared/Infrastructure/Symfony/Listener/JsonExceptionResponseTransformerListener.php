<?php

namespace App\Shared\Infrastructure\Symfony\Listener;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class JsonExceptionResponseTransformerListener
{
    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        if ($exception instanceof HttpExceptionInterface) {
            $data = [
                'class' => get_class($exception),
                'message' => $exception->getMessage(),
                'code' => $exception->getStatusCode(),
            ];
            $event->setResponse($this->prepareResponse($data, $data['code']));
        }

    }


    private function prepareResponse(array $data, int $statusCode): JsonResponse
    {
        $response = new JsonResponse($data, $statusCode);
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Server-Time', \time());
        $response->headers->set('X-Error-code', $statusCode);

        return $response;
    }


}