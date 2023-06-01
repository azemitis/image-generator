<?php declare(strict_types=1);

namespace App\Models;

class Image
{
    private int $id;
    private string $filename;
    private int $width;
    private int $height;
    private string $path;

    public function __construct(int $id, string $filename, int $width, int $height, string $path)
    {
        $this->id = $id;
        $this->filename = $filename;
        $this->width = $width;
        $this->height = $height;
        $this->path = $path;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }

    public function getPath(): string
    {
        return $this->path;
    }
}