<?php declare(strict_types=1);

namespace App;

use Carbon\Carbon;

class Cache
{
    public static function remember(string $key, $data, int $ttl): void
    {
        $cacheFile = self::getCacheFilePath($key);
        self::forget($key);

        if (!empty($cacheFile)) {
            file_put_contents($cacheFile, serialize([
                'expires_at' => Carbon::now()->addSeconds($ttl),
                'content' => $data
            ]));
        }
    }


    public static function forget(string $key): void
    {
        $cacheFile = self::getCacheFilePath($key);

        if (file_exists($cacheFile)) {
            $content = unserialize(file_get_contents($cacheFile));
            $expiresAt = Carbon::parse($content['expires_at']);

            if (Carbon::now() > $expiresAt) {
                unlink($cacheFile);
            }
        }
    }

    public static function get(string $key)
    {
        if (!self::has($key)) {
            return null;
        }

        $cacheFile = self::getCacheFilePath($key);
        $content = unserialize(file_get_contents($cacheFile));

        return $content['content'];
    }

    public static function has(string $key): bool
    {
        $cacheFile = self::getCacheFilePath($key);

        if (!file_exists($cacheFile)) {
            return false;
        }

        $content = unserialize(file_get_contents($cacheFile));

        return Carbon::now() < Carbon::parse($content['expires_at']);
    }

    private static function getCacheFilePath(string $key): string
    {
        $cacheDirectory = __DIR__ . '/../cache/';
        $cleanedKey = preg_replace('/[^a-zA-Z0-9\-_.]/', '', $key);

        if (strpos($key, 'processed_image_') === 0) {
            return '';
        }

        return $cacheDirectory . $cleanedKey;
    }
}