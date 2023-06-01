<?php declare(strict_types=1);

namespace App\Services;

use Intervention\Image\ImageManager;

class ImageProcessor
{
    public static function mainProcessor(string $imagePath): array
    {
        $manager = new ImageManager(['driver' => 'gd']);
        $image = $manager->make($imagePath);

        $image->pixelate(1);
        $tempPath = __DIR__ . '/../../storage/temp.png';

        $image->save($tempPath);

        $tempImage = imagecreatefrompng($tempPath);
        $transparentImage = self::makeTransparent($tempImage);

        imagealphablending($transparentImage, false);
        imagesavealpha($transparentImage, true);

        imagepng($transparentImage, $tempPath);

        $image->destroy();
        imagedestroy($tempImage);
        imagedestroy($transparentImage);

        $resizedImage = self::resize($tempPath);

        return [
            'width' => $resizedImage->width(),
            'height' => $resizedImage->height(),
            'dataUrl' => $resizedImage->encode('data-url')->encoded,
        ];
    }

    public static function resize(string $imagePath): \Intervention\Image\Image
    {
        $manager = new ImageManager();
        $image = $manager->make($imagePath)->resize(362, 544);

        return $image;
    }

    public static function makeTransparent($image)
    {
        $width = imagesx($image);
        $height = imagesy($image);

        $transparentImage = imagecreatetruecolor($width, $height);
        $transparentColor = imagecolorallocatealpha($transparentImage, 0, 0, 0, 127);
        imagefill($transparentImage, 0, 0, $transparentColor);

        for ($x = 0; $x < $width; $x++) {
            for ($y = 0; $y < $height; $y++) {
                $rgb = imagecolorat($image, $x, $y);
                $alpha = ($rgb >> 24) & 0xFF;
                $red = ($rgb >> 16) & 0xFF;
                $green = ($rgb >> 8) & 0xFF;
                $blue = $rgb & 0xFF;

                if ($red >= 220 && $green >= 220 && $blue >= 220) {
                    $alpha = 127;
                }

                $color = imagecolorallocatealpha($transparentImage, $red, $green, $blue, $alpha);
                imagesetpixel($transparentImage, $x, $y, $color);
            }
        }

        return $transparentImage;
    }
}