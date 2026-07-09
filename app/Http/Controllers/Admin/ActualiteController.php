<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreActualiteRequest;
use App\Http\Requests\Admin\UpdateActualiteRequest;
use App\Models\Actualite;
use App\Services\ActualiteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActualiteController extends Controller
{
    public function __construct(private readonly ActualiteService $actualites) {}

    public function index(Request $request): View
    {
        $this->authorize('viewAny', Actualite::class);

        $search = $request->string('q')->trim()->toString();

        return view('admin.actualites.index', [
            'actualites' => Actualite::query()
                ->when($search !== '', fn ($query) => $query->where('title', 'like', "%{$search}%"))
                ->latest('published_at')
                ->paginate(15)
                ->withQueryString(),
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Actualite::class);

        return view('admin.actualites.create');
    }

    public function store(StoreActualiteRequest $request): RedirectResponse
    {
        $this->actualites->create($request->safe()->except('image'), $request->file('image'));

        return redirect()->route('admin.actualites.index')->with('status', 'Actualité créée.');
    }

    public function edit(Actualite $actualite): View
    {
        $this->authorize('update', $actualite);

        return view('admin.actualites.edit', ['actualite' => $actualite]);
    }

    public function update(UpdateActualiteRequest $request, Actualite $actualite): RedirectResponse
    {
        $this->actualites->update($actualite, $request->safe()->except('image'), $request->file('image'));

        return redirect()->route('admin.actualites.index')->with('status', 'Actualité mise à jour.');
    }

    public function destroy(Actualite $actualite): RedirectResponse
    {
        $this->authorize('delete', $actualite);

        $this->actualites->delete($actualite);

        return redirect()->route('admin.actualites.index')->with('status', 'Actualité supprimée.');
    }
}
