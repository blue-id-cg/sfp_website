<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

/**
 * For models with an "image" column that may hold either a path uploaded to the
 * public disk, or the bare filename of an image pre-optimized at design time.
 */
trait HasImageUrl
{
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
