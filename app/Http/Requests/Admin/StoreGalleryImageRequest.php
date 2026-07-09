<?php

namespace App\Http\Requests\Admin;

use App\Models\GalleryImage;
use Illuminate\Foundation\Http\FormRequest;

class StoreGalleryImageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', GalleryImage::class) ?? false;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string', 'max:255'],
            'caption' => ['nullable', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:4096'],
            'position' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
