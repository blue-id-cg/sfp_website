<?php

namespace App\Services;

use App\Models\Realisation;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class RealisationService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data, ?UploadedFile $image = null): Realisation
    {
        if ($image) {
            $data['image'] = $this->storeImage($image);
        }

        return Realisation::query()->create($data);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Realisation $realisation, array $data, ?UploadedFile $image = null): Realisation
    {
        if ($image) {
            $this->deleteImage($realisation);
            $data['image'] = $this->storeImage($image);
        }

        $realisation->update($data);

        return $realisation;
    }

    public function delete(Realisation $realisation): void
    {
        $this->deleteImage($realisation);
        $realisation->delete();
    }

    private function storeImage(UploadedFile $image): string
    {
        return $image->store('realisations', 'public');
    }

    private function deleteImage(Realisation $realisation): void
    {
        if ($realisation->image && str_contains($realisation->image, '/')) {
            Storage::disk('public')->delete($realisation->image);
        }
    }
}
