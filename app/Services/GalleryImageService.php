<?php

namespace App\Services;

use App\Models\GalleryImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class GalleryImageService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data, UploadedFile $image): GalleryImage
    {
        $data['image'] = $image->store('gallery', 'public');
        $data['position'] ??= $this->nextPosition();

        return GalleryImage::query()->create($data);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(GalleryImage $galleryImage, array $data, ?UploadedFile $image = null): GalleryImage
    {
        if ($image) {
            $this->deleteImage($galleryImage);
            $data['image'] = $image->store('gallery', 'public');
        }

        $galleryImage->update($data);

        return $galleryImage;
    }

    public function delete(GalleryImage $galleryImage): void
    {
        $this->deleteImage($galleryImage);
        $galleryImage->delete();
    }

    private function nextPosition(): int
    {
        return (int) (GalleryImage::query()->max('position') ?? 0) + 1;
    }

    private function deleteImage(GalleryImage $galleryImage): void
    {
        if ($galleryImage->image && str_contains($galleryImage->image, '/')) {
            Storage::disk('public')->delete($galleryImage->image);
        }
    }
}
