<?php

namespace App\Services;

use App\Exceptions\ContactNotificationUnavailable;
use App\Mail\ContactMessageReceived;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ContactService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function submit(array $data, ?UploadedFile $cv = null): ContactMessage
    {
        $cvPath = null;

        try {
            if ($cv !== null) {
                $cvPath = $cv->store('candidatures');
                $data['cv_path'] = $cvPath;
                $data['cv_filename'] = $cv->getClientOriginalName();
            }

            $message = DB::transaction(fn () => ContactMessage::query()->create($data));
        } catch (\Throwable $exception) {
            if ($cvPath !== null) {
                Storage::disk('local')->delete($cvPath);
            }

            throw $exception;
        }

        $recipients = array_unique(array_filter([
            config('mail.admin_address'),
            $message->type === 'application' ? SiteSetting::current()->contact_email : null,
        ]));

        if (in_array(config('mail.default'), ['log', 'array'], true) && ! app()->environment('testing')) {
            throw new ContactNotificationUnavailable;
        }

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
