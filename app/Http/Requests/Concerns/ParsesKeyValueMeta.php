<?php

namespace App\Http\Requests\Concerns;

/**
 * For requests accepting textarea input ("key: value" one pair per line) for a field stored as
 * an associative JSON array.
 */
trait ParsesKeyValueMeta
{
    protected function prepareMetaField(string $field = 'meta'): void
    {
        if ($this->filled($field) && is_string($this->input($field))) {
            $this->merge([$field => $this->parseKeyValueMeta($this->string($field)->toString())]);
        }
    }

    /**
     * @return array<string, string>
     */
    private function parseKeyValueMeta(string $value): array
    {
        $meta = [];

        foreach (preg_split('/\r\n|\r|\n/', $value) as $line) {
            if (! str_contains($line, ':')) {
                continue;
            }

            [$key, $val] = explode(':', $line, 2);
            $key = trim($key);

            if ($key !== '') {
                $meta[$key] = trim($val);
            }
        }

        return $meta;
    }
}
