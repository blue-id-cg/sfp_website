<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Services\ContactService;
use App\Support\LikeSearch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
                ->when($search !== '', fn ($query) => $query->where(function ($query) use ($search) {
                    LikeSearch::apply($query, 'name', $search);
                    $query->orWhere(function ($query) use ($search) {
                        LikeSearch::apply($query, 'email', $search);
                    });
                    $query->orWhere(function ($query) use ($search) {
                        LikeSearch::apply($query, 'subject', $search);
                    });
                }))
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

        if ($message->cv_path !== null) {
            Storage::disk('local')->delete($message->cv_path);
        }

        $message->delete();

        return redirect()->route('admin.messages.index')->with('status', 'Message supprimé.');
    }

    public function cv(ContactMessage $message): mixed
    {
        $this->authorize('view', $message);

        abort_unless($message->cv_path !== null, 404);

        return response()->download(
            Storage::disk('local')->path($message->cv_path),
            $message->cv_filename,
        );
    }
}
