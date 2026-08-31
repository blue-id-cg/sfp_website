<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Concerns\ParsesLineDelimitedFields;
use App\Http\Requests\Concerns\PreparesSlugField;
use App\Models\Offre;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOffreRequest extends FormRequest
{
    use ParsesLineDelimitedFields, PreparesSlugField;

    public function authorize(): bool
    {
        return $this->user()?->can('create', Offre::class) ?? false;
    }

    protected function prepareForValidation(): void
    {
        $this->prepareLineDelimitedFields(['tags', 'missions', 'profile']);
        $this->prepareSlug(Offre::class);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('offres', 'slug')],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['string', 'max:100'],
            'summary' => ['nullable', 'string', 'max:1000'],
            'missions' => ['nullable', 'array'],
            'missions.*' => ['string', 'max:500'],
            'profile' => ['nullable', 'array'],
            'profile.*' => ['string', 'max:500'],
            'published_at' => ['nullable', 'date'],
        ];
    }
}
