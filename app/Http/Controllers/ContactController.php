<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Services\ContactService;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function __construct(private readonly ContactService $contact) {}

    public function store(StoreContactRequest $request): RedirectResponse
    {
        $this->contact->submit($request->validated());

        return back()->with('contact_sent', true);
    }
}
