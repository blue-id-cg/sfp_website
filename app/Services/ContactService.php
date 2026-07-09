<?php

namespace App\Services;

use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use Illuminate\Support\Facades\Mail;

class ContactService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function submit(array $data): ContactMessage
    {
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
