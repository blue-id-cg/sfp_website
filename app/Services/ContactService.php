<?php

namespace App\Services;

use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
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
            $data['cv_path'] = $cv->store('candidatures');
        }

        $message = ContactMessage::query()->create($data);

        $recipients = array_unique(array_filter([
            config('mail.admin_address'),
            $message->type === 'application' ? SiteSetting::current()->contact_email : null,
        ]));

        Mail::to($recipients)->send(new ContactMessageReceived($message));

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
