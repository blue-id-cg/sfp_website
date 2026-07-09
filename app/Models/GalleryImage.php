<?php

namespace App\Models;

use Database\Factories\GalleryImageFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable(['title', 'caption', 'image', 'position'])]
class GalleryImage extends Model
{
    /** @use HasFactory<GalleryImageFactory> */
    use HasFactory;

    protected function imageUrl(): Attribute
    {
        return Attribute::make(get: function () {
            if (! $this->image) {
                return null;
            }

            return str_contains($this->image, '/')
                ? Storage::disk('public')->url($this->image)
                : asset('images/opt/'.$this->image.'.jpg');
        });
    }
}
