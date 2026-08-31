<?php

namespace App\Http\Requests\Concerns;

/**
 * For requests accepting textarea input (one item per line) for fields stored as arrays.
 */
trait ParsesLineDelimitedFields
{
    /**
     * @param  list<string>  $fields
     */
    protected function prepareLineDelimitedFields(array $fields): void
    {
        foreach ($fields as $field) {
            if ($this->filled($field) && is_string($this->input($field))) {
                $this->merge([$field => $this->linesToArray($this->string($field)->toString())]);
            }
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
}
