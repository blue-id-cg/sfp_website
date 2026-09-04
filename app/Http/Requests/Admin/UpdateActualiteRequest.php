<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Concerns\PreparesSlugField;
use App\Models\Actualite;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateActualiteRequest extends FormRequest
{
    use PreparesSlugField;

    public function authorize(): bool
    {
        return $this->user()?->can('update', $this->route('actualite')) ?? false;
    }

    protected function prepareForValidation(): void
    {
        $this->prepareSlug(Actualite::class, $this->route('actualite')->id);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('actualites', 'slug')->ignore($this->route('actualite')?->id)],
            'category' => ['nullable', 'string', 'max:100'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'body' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'published_at' => ['nullable', 'date'],
        ];
    }
}
