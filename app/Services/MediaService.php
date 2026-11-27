<?php

namespace App\Services;

use App\Models\Media;
use App\Support\ImageOptimizer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaService
{
    public function store(UploadedFile $file, ?int $uploadedBy = null, ?string $altText = null): Media
    {
        $path = (new ImageOptimizer)->store($file, 'media');
        $mimeType = str_ends_with($path, '.webp') ? 'image/webp' : $file->getMimeType();
        $size = Storage::disk('public')->size($path);

        return Media::query()->create([
            'disk' => 'public',
            'path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $mimeType,
            'size' => $size,
            'alt_text' => $altText,
            'uploaded_by' => $uploadedBy,
        ]);
    }

    public function delete(Media $media): void
    {
        Storage::disk($media->disk)->delete($media->path);
        $media->delete();
    }
}
