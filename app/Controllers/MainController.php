<?php declare(strict_types=1);

namespace App\Controllers;

use App\Core\TwigRenderer;
use App\Services\ImageService;

class MainController
{
    private TwigRenderer $twigRenderer;

    public function __construct(TwigRenderer $twigRenderer)
    {
        $this->twigRenderer = $twigRenderer;
    }

    public function index(): string
    {
        $images = $this->getImageService()->getProcessedImages();

        return $this->twigRenderer->render('collage.html.twig', ['images' => $images]);
    }

    private function getImageService(): ImageService
    {
        $this->imageService = new ImageService();

        return $this->imageService;
    }
}