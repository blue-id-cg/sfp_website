<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Concerns\ParsesKeyValueMeta;
use App\Models\ContentBlock;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContentBlockRequest extends FormRequest
{
    use ParsesKeyValueMeta;

    public function authorize(): bool
    {
        return $this->user()?->can('update', $this->route('contentBlock')) ?? false;
    }

    protected function prepareForValidation(): void
    {
        $this->prepareMetaField();
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'group' => ['required', 'string', Rule::in(array_keys(ContentBlock::GROUP_LABELS))],
            'icon' => ['nullable', 'string', Rule::in(ContentBlock::iconChoices())],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'meta' => ['nullable', 'array'],
            'position' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
