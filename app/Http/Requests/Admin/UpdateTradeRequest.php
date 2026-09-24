<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Concerns\PreparesSlugField;
use App\Models\ContentBlock;
use App\Models\Trade;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTradeRequest extends FormRequest
{
    use PreparesSlugField;

    public function authorize(): bool
    {
        return $this->user()?->can('update', $this->route('trade')) ?? false;
    }

    protected function prepareForValidation(): void
    {
        $this->prepareSlug(Trade::class, $this->route('trade')->id);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('trades', 'slug')->ignore($this->route('trade')?->id)],
            'icon' => ['nullable', 'string', Rule::in(ContentBlock::iconChoices())],
            'description' => ['nullable', 'string', 'max:1000'],
            'body' => ['nullable', 'string'],
            'position' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
