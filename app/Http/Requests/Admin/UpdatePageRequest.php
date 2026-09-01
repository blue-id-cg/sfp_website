<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->can('update', $this->route('page')) ?? false;
    }

    /**
     * Built from config('pages.schemas.{slug}') so every field the edit form renders is
     * validated, and nothing else is accepted.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $schema = config("pages.schemas.{$this->route('page')->slug}", []);
        $rules = [];

        foreach ($schema as $sectionKey => $section) {
            foreach (array_keys($section['fields']) as $fieldKey) {
                $rules["content.{$sectionKey}.{$fieldKey}"] = ['nullable', 'string', 'max:5000'];
            }
        }

        return $rules;
    }
}
