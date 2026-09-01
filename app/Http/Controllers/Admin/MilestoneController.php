<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMilestoneRequest;
use App\Http\Requests\Admin\UpdateMilestoneRequest;
use App\Models\Milestone;
use App\Services\MilestoneService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MilestoneController extends Controller
{
    public function __construct(private readonly MilestoneService $milestones) {}

    public function index(): View
    {
        $this->authorize('viewAny', Milestone::class);

        return view('admin.milestones.index', [
            'milestones' => Milestone::query()->orderBy('position')->paginate(20),
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Milestone::class);

        return view('admin.milestones.create');
    }

    public function store(StoreMilestoneRequest $request): RedirectResponse
    {
        $this->milestones->create($request->validated());

        return redirect()->route('admin.milestones.index')->with('status', 'Étape ajoutée à la frise.');
    }

    public function edit(Milestone $milestone): View
    {
        $this->authorize('update', $milestone);

        return view('admin.milestones.edit', ['milestone' => $milestone]);
    }

    public function update(UpdateMilestoneRequest $request, Milestone $milestone): RedirectResponse
    {
        $this->milestones->update($milestone, $request->validated());

        return redirect()->route('admin.milestones.index')->with('status', 'Étape mise à jour.');
    }

    public function destroy(Milestone $milestone): RedirectResponse
    {
        $this->authorize('delete', $milestone);

        $this->milestones->delete($milestone);

        return redirect()->route('admin.milestones.index')->with('status', 'Étape supprimée.');
    }
}
