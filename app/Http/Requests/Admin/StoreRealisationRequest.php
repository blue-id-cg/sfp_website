<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Concerns\ParsesIconTextPairs;
use App\Http\Requests\Concerns\ParsesLineDelimitedFields;
use App\Http\Requests\Concerns\PreparesSlugField;
use App\Models\Realisation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRealisationRequest extends FormRequest
{
    use ParsesIconTextPairs, ParsesLineDelimitedFields, PreparesSlugField;

    public function authorize(): bool
    {
        return $this->user()?->can('create', Realisation::class) ?? false;
    }

    protected function prepareForValidation(): void
    {
        $this->prepareLineDelimitedFields(['tags']);
        $this->prepareIconTextField('facts');
        $this->prepareSlug(Realisation::class);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('realisations', 'slug')],
            'category' => ['nullable', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'max:4096'],
            'facts' => ['nullable', 'array'],
            'facts.*.icon' => ['nullable', 'string', 'max:100'],
            'facts.*.text' => ['required', 'string', 'max:255'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['string', 'max:100'],
            'position' => ['nullable', 'integer', 'min:0'],
            'published_at' => ['nullable', 'date'],
        ];
    }
}
