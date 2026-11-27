<?php

namespace App\Http\Controllers;

use App\Exceptions\ContactNotificationUnavailable;
use App\Http\Requests\StoreContactRequest;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class ContactController extends Controller
{
    public function __construct(private readonly ContactService $contact) {}

    public function store(StoreContactRequest $request): RedirectResponse|JsonResponse
    {
        try {
            $this->contact->submit($request->safe()->except('cv'), $request->file('cv'));
        } catch (ContactNotificationUnavailable|TransportExceptionInterface $exception) {
            if ($exception instanceof TransportExceptionInterface) {
                report($exception);
            }

            $message = $exception instanceof ContactNotificationUnavailable
                ? "Votre demande a été enregistrée, mais le service d'envoi d'e-mails n'est pas configuré pour envoyer des messages."
                : "Votre demande a été enregistrée, mais l'e-mail de notification n'a pas pu être envoyé. Vous pouvez nous contacter directement à l'adresse indiquée sur le site.";

            if ($request->expectsJson()) {
                return response()->json(['message' => $message], 503);
            }

            return back()->withInput()->with('contact_error', $message);
        }

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Votre demande a bien été enregistrée. Notre équipe vous recontactera.']);
        }

        return back()->with('contact_sent', true);
    }
}
