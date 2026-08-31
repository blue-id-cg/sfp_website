<?php

namespace App\Http\Requests\Concerns;

use Illuminate\Support\Str;

/**
 * For requests validating a model that generates its "slug" from "title" via
 * a HasUniqueSlug model (see App\Models\Concerns\HasUniqueSlug).
 */
trait PreparesSlugField
{
    /**
     * @param  class-string  $modelClass
     */
    protected function prepareSlug(string $modelClass, ?int $ignoreId = null): void
    {
        if ($this->filled('slug')) {
            $this->merge(['slug' => Str::slug($this->string('slug'))]);
        } elseif ($this->filled('title')) {
            $this->merge(['slug' => $modelClass::generateUniqueSlug($this->string('title'), $ignoreId)]);
        }
    }
}
