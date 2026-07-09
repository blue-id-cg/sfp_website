<?php

namespace App\Http\Requests\Admin;

use App\Models\Offre;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreOffreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('create', Offre::class) ?? false;
    }

    protected function prepareForValidation(): void
    {
        foreach (['tags', 'missions', 'profile'] as $field) {
            if ($this->filled($field) && is_string($this->input($field))) {
                $this->merge([$field => $this->linesToArray($this->string($field)->toString())]);
            }
        }

        if ($this->filled('slug')) {
            $this->merge(['slug' => Str::slug($this->string('slug'))]);
        } elseif ($this->filled('title')) {
            $this->merge(['slug' => Offre::generateUniqueSlug($this->string('title'))]);
        }
    }

    /**
     * @return array<int, string>
     */
    private function linesToArray(string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $value))
            ->map(fn (string $line) => trim($line))
            ->filter()
            ->values()
            ->all();
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
