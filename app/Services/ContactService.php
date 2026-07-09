<?php

namespace App\Services;

use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;

class ContactService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function submit(array $data, ?UploadedFile $cv = null): ContactMessage
    {
        if ($cv !== null) {
            $data['cv_path'] = $cv->store('candidatures', 'public');
        }

        $message = ContactMessage::query()->create($data);

        Mail::to(config('mail.admin_address'))->send(new ContactMessageReceived($message));

        return $message;
    }

    public function markAsRead(ContactMessage $message): ContactMessage
    {
        if ($message->read_at === null) {
            $message->update(['read_at' => now()]);
        }

        return $message;
    }
}
