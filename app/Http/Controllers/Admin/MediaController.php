<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMediaRequest;
use App\Models\Media;
use App\Services\MediaService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class MediaController extends Controller
{
    public function __construct(private readonly MediaService $media) {}

    public function index(Request $request): View
    {
        $this->authorize('viewAny', Media::class);

        return view('admin.media.index', [
            'media' => Media::query()->latest()->paginate(24)->withQueryString(),
            'pickerFor' => $request->string('picker_for')->trim()->toString() ?: null,
            'returnTo' => $this->safeReturnTo($request->string('return_to')->toString()),
        ]);
    }

    public function store(StoreMediaRequest $request): RedirectResponse
    {
        $this->media->store($request->file('file'), Auth::id(), $request->string('alt_text')->toString() ?: null);

        return back()->with('status', 'Média ajouté à la médiathèque.');
    }

    public function destroy(Media $media): RedirectResponse
    {
        $this->authorize('delete', $media);

        $this->media->delete($media);

        return redirect()->route('admin.media.index')->with('status', 'Média supprimé.');
    }

    /**
     * Only accept an internal, relative "return_to" path to avoid the media picker being used
     * as an open redirect.
     */
    private function safeReturnTo(string $returnTo): ?string
    {
        if ($returnTo === '' || ! str_starts_with($returnTo, '/') || str_starts_with($returnTo, '//')) {
            return null;
        }

        return $returnTo;
    }
}
