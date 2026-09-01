<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdatePageRequest;
use App\Models\Page;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        $this->authorize('viewAny', Page::class);

        return view('admin.pages.index', [
            'pages' => Page::query()->orderBy('slug')->get(),
            'labels' => config('pages.labels'),
        ]);
    }

    public function edit(Page $page): View
    {
        $this->authorize('update', $page);

        return view('admin.pages.edit', [
            'page' => $page,
            'schema' => config("pages.schemas.{$page->slug}", []),
            'label' => config("pages.labels.{$page->slug}", $page->slug),
        ]);
    }

    public function update(UpdatePageRequest $request, Page $page): RedirectResponse
    {
        $page->update(['content' => $request->validated('content', [])]);

        return redirect()->route('admin.pages.edit', $page)->with('status', 'Page mise à jour.');
    }
}
