<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class DownloadAssetController extends AbstractController
{
    #[Route('/res/{path}', name: 'app_download_asset')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'packages/src/Controller/DownloadAssetController.php',
        ]);
    }
}
