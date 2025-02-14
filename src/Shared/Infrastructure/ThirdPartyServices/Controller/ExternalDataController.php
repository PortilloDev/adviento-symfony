<?php

namespace App\Shared\Infrastructure\ThirdPartyServices\Controller;

use App\Shared\Infrastructure\Symfony\Controller\AbstractApiController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Shared\Infrastructure\ThirdPartyServices\Services\ExternalApiService;
class ExternalDataController extends AbstractController
{
    public function __construct(private ExternalApiService $externalApi)
    {
    }

    #[Route('/api/third_party/data', name: 'get_external_data', methods: ['GET'])]
    public function getDatos(): JsonResponse
    {
        if (!$this->isGranted('VIEW_EXTERNAL_DATA')) {
            throw new AccessDeniedException('No tienes permiso para ver estos datos.');
        }

        $data = $this->externalApi->fetchData();
        return new JsonResponse($data);
    }
}