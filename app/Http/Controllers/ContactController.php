<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Services\ContactService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function __construct(private readonly ContactService $contact) {}

    public function store(StoreContactRequest $request): RedirectResponse|JsonResponse
    {
        $this->contact->submit($request->safe()->except('cv'), $request->file('cv'));

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Votre demande a bien été envoyée.']);
        }

        return back()->with('contact_sent', true);
    }
}
