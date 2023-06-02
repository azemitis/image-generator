<?php declare(strict_types=1);

namespace App\Services;

use App\Models\Image;
use App\Repositories\ImageRepository;
use App\Cache;

class ImageService
{
    public function getProcessedImages(): array
    {
        $path = __DIR__ . '/../../public/assets';
        $images = ImageRepository::getImages($path);

        $processedImages = [];
        foreach ($images as $image) {
            $cacheKey = 'image_' . $image['name'];
            if (Cache::has($cacheKey)) {
                $processedImage = Cache::get($cacheKey);
            } else {
                $processedImage = ImageProcessor::mainProcessor($path . '/' . $image['name']);
                Cache::remember($cacheKey, $processedImage, 3600);
            }

            $imageModel = new Image(0, $image['name'], $processedImage['width'],
                $processedImage['height'], $processedImage['dataUrl']);
            $processedImages[] = $imageModel;
        }

        return $processedImages;
    }
}