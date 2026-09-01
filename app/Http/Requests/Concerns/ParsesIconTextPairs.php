<?php

namespace App\Http\Requests\Concerns;

/**
 * For requests accepting textarea input, one "icon|texte" pair per line, for a field stored as
 * an array of {icon, text} objects.
 */
trait ParsesIconTextPairs
{
    protected function prepareIconTextField(string $field): void
    {
        if ($this->filled($field) && is_string($this->input($field))) {
            $this->merge([$field => $this->linesToIconTextPairs($this->string($field)->toString())]);
        }
    }

    /**
     * @return list<array{icon: ?string, text: string}>
     */
    private function linesToIconTextPairs(string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $value))
            ->map(fn (string $line) => trim($line))
            ->filter()
            ->map(function (string $line) {
                [$icon, $text] = str_contains($line, '|') ? explode('|', $line, 2) : [null, $line];

                return ['icon' => $icon ? trim($icon) : null, 'text' => trim($text)];
            })
            ->values()
            ->all();
    }
}
