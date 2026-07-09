<?php

namespace App\Services;

use App\Models\Actualite;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ActualiteService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data, ?UploadedFile $image = null): Actualite
    {
        if ($image) {
            $data['image'] = $this->storeImage($image);
        }

        return Actualite::query()->create($data);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Actualite $actualite, array $data, ?UploadedFile $image = null): Actualite
    {
        if ($image) {
            $this->deleteImage($actualite);
            $data['image'] = $this->storeImage($image);
        }

        $actualite->update($data);

        return $actualite;
    }

    public function delete(Actualite $actualite): void
    {
        $this->deleteImage($actualite);
        $actualite->delete();
    }

    private function storeImage(UploadedFile $image): string
    {
        return $image->store('actualites', 'public');
    }

    private function deleteImage(Actualite $actualite): void
    {
        if ($actualite->image && str_contains($actualite->image, '/')) {
            Storage::disk('public')->delete($actualite->image);
        }
    }
}
