<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Services\ContactService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function __construct(private readonly ContactService $contact) {}

    public function index(Request $request): View
    {
        $this->authorize('viewAny', ContactMessage::class);

        $search = $request->string('q')->trim()->toString();
        $status = $request->string('status')->trim()->toString();

        return view('admin.messages.index', [
            'messages' => ContactMessage::query()
                ->when($search !== '', fn ($query) => $query->where(fn ($q) => $q
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('subject', 'like', "%{$search}%")))
                ->when($status === 'unread', fn ($query) => $query->whereNull('read_at'))
                ->when($status === 'read', fn ($query) => $query->whereNotNull('read_at'))
                ->latest()
                ->paginate(20)
                ->withQueryString(),
            'search' => $search,
            'status' => $status,
        ]);
    }

    public function show(ContactMessage $message): View
    {
        $this->authorize('view', $message);

        $this->contact->markAsRead($message);

        return view('admin.messages.show', ['message' => $message]);
    }

    public function destroy(ContactMessage $message): RedirectResponse
    {
        $this->authorize('delete', $message);

        $message->delete();

        return redirect()->route('admin.messages.index')->with('status', 'Message supprimé.');
    }
}
