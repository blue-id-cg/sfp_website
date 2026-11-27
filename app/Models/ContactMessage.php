<?php

namespace App\Models;

use Database\Factories\ContactMessageFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['type', 'name', 'email', 'phone', 'subject', 'message', 'cv_path', 'cv_filename', 'read_at'])]
class ContactMessage extends Model
{
    /** @use HasFactory<ContactMessageFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'read_at' => 'datetime',
        ];
    }

    protected function cvFilename(): Attribute
    {
        return Attribute::make(get: function (): ?string {
            $storedName = $this->getRawOriginal('cv_filename');

            return is_string($storedName) && $storedName !== ''
                ? $storedName
                : ($this->cv_path ? basename($this->cv_path) : null);
        });
    }
}
