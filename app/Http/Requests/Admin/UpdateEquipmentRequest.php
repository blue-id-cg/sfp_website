<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Concerns\PreparesSlugField;
use App\Models\Equipment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEquipmentRequest extends FormRequest
{
    use PreparesSlugField;

    public function authorize(): bool
    {
        return $this->user()?->can('update', $this->route('equipment')) ?? false;
    }

    protected function prepareForValidation(): void
    {
        $this->prepareSlug(Equipment::class, $this->route('equipment')->id);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique('equipment', 'slug')->ignore($this->route('equipment')?->id)],
            'description' => ['nullable', 'string', 'max:1000'],
            'body' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'spec_sheet' => ['nullable', 'file', 'mimes:pdf', 'max:8192'],
            'trades' => ['nullable', 'array'],
            'trades.*' => ['integer', Rule::exists('trades', 'id')],
            'position' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
