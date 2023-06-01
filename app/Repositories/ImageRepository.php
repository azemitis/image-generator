<?php declare(strict_types=1);

namespace App\Repositories;

class ImageRepository
{
    public static function getImages(string $path): array
    {
        $files = scandir($path);
        sort($files, SORT_NATURAL);
        $images = [];
        $count = 0;

        foreach ($files as $image) {
            if ($count >= 10) {
                break;
            }

            if (is_file($path . '/' . $image)) {
                $images[] = ['name' => $image];
                $count++;
            }
        }

        return $images;
    }
}