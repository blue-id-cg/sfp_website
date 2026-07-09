<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreOffreRequest;
use App\Http\Requests\Admin\UpdateOffreRequest;
use App\Models\Offre;
use App\Services\OffreService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class OffreController extends Controller
{
    public function __construct(private readonly OffreService $offres) {}

    public function index(): View
    {
        $this->authorize('viewAny', Offre::class);

        return view('admin.offres.index', [
            'offres' => Offre::query()->latest('published_at')->paginate(15),
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Offre::class);

        return view('admin.offres.create');
    }

    public function store(StoreOffreRequest $request): RedirectResponse
    {
        $this->offres->create($request->validated());

        return redirect()->route('admin.offres.index')->with('status', 'Offre créée.');
    }

    public function edit(Offre $offre): View
    {
        $this->authorize('update', $offre);

        return view('admin.offres.edit', ['offre' => $offre]);
    }

    public function update(UpdateOffreRequest $request, Offre $offre): RedirectResponse
    {
        $this->offres->update($offre, $request->validated());

        return redirect()->route('admin.offres.index')->with('status', 'Offre mise à jour.');
    }

    public function destroy(Offre $offre): RedirectResponse
    {
        $this->authorize('delete', $offre);

        $this->offres->delete($offre);

        return redirect()->route('admin.offres.index')->with('status', 'Offre supprimée.');
    }
}
