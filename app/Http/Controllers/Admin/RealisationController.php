<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreRealisationRequest;
use App\Http\Requests\Admin\UpdateRealisationRequest;
use App\Models\Realisation;
use App\Services\RealisationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RealisationController extends Controller
{
    public function __construct(private readonly RealisationService $realisations) {}

    public function index(Request $request): View
    {
        $this->authorize('viewAny', Realisation::class);

        $search = $request->string('q')->trim()->toString();

        return view('admin.realisations.index', [
            'realisations' => Realisation::query()
                ->when($search !== '', fn ($query) => $query->where('title', 'like', "%{$search}%"))
                ->orderBy('position')
                ->paginate(15)
                ->withQueryString(),
            'search' => $search,
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Realisation::class);

        return view('admin.realisations.create');
    }

    public function store(StoreRealisationRequest $request): RedirectResponse
    {
        $this->realisations->create($request->safe()->except('image'), $request->file('image'));

        return redirect()->route('admin.realisations.index')->with('status', 'Réalisation créée.');
    }

    public function edit(Realisation $realisation): View
    {
        $this->authorize('update', $realisation);

        return view('admin.realisations.edit', ['realisation' => $realisation]);
    }

    public function update(UpdateRealisationRequest $request, Realisation $realisation): RedirectResponse
    {
        $this->realisations->update($realisation, $request->safe()->except('image'), $request->file('image'));

        return redirect()->route('admin.realisations.index')->with('status', 'Réalisation mise à jour.');
    }

    public function destroy(Realisation $realisation): RedirectResponse
    {
        $this->authorize('delete', $realisation);

        $this->realisations->delete($realisation);

        return redirect()->route('admin.realisations.index')->with('status', 'Réalisation supprimée.');
    }
}
