<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Image;
use App\Repositories\ImageRepository;

class ImageService
{
    public function getProcessedImages(): array
    {
        $path = __DIR__ . '/../../public/assets';
        $images = ImageRepository::getImages($path);

        $processedImages = [];
        foreach ($images as $image) {
            $processedImage = ImageProcessor::mainProcessor($path . '/' . $image['name']);
            $imageModel = new Image(0, $image['name'], $processedImage['width'],
                $processedImage['height'], $processedImage['dataUrl']);
            $processedImages[] = $imageModel;
        }

        return $processedImages;
    }
}