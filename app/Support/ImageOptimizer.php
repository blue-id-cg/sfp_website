<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageOptimizer
{
    public function store(UploadedFile $image, string $directory): string
    {
        if (
            ! function_exists('imagecreatefromjpeg')
            || ! function_exists('imagecreatefrompng')
            || ! function_exists('imagecreatefromwebp')
            || ! function_exists('imagewebp')
        ) {
            return $image->store($directory, 'public');
        }

        $source = match (strtolower($image->getClientOriginalExtension())) {
            'jpg', 'jpeg' => @imagecreatefromjpeg($image->getRealPath()),
            'png' => @imagecreatefrompng($image->getRealPath()),
            'webp' => @imagecreatefromwebp($image->getRealPath()),
            default => false,
        };

        if (! is_resource($source) && ! $source instanceof \GdImage) {
            return $image->store($directory, 'public');
        }

        $width = imagesx($source);
        $height = imagesy($source);
        $ratio = min(1600 / $width, 1600 / $height, 1);
        $targetWidth = max(1, (int) round($width * $ratio));
        $targetHeight = max(1, (int) round($height * $ratio));

        $optimized = imagecreatetruecolor($targetWidth, $targetHeight);
        imagealphablending($optimized, false);
        imagesavealpha($optimized, true);
        imagecopyresampled(
            $optimized,
            $source,
            0,
            0,
            0,
            0,
            $targetWidth,
            $targetHeight,
            $width,
            $height,
        );

        ob_start();
        imagewebp($optimized, null, 82);
        $contents = ob_get_clean();
        imagedestroy($source);
        imagedestroy($optimized);

        if (! is_string($contents) || $contents === '') {
            return $image->store($directory, 'public');
        }

        $path = trim($directory, '/').'/'.Str::uuid().'.webp';
        Storage::disk('public')->put($path, $contents);

        return $path;
    }
}
