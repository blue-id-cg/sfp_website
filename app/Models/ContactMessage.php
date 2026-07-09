<?php

namespace App\Models;

use Database\Factories\ContactMessageFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[Fillable(['name', 'email', 'phone', 'subject', 'message', 'cv_path', 'read_at'])]
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

    protected function cvUrl(): Attribute
    {
        return Attribute::make(get: fn () => $this->cv_path ? Storage::disk('public')->url($this->cv_path) : null);
    }

    protected function cvFilename(): Attribute
    {
        return Attribute::make(get: fn () => $this->cv_path ? basename($this->cv_path) : null);
    }
}
