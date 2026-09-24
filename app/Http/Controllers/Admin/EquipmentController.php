<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEquipmentRequest;
use App\Http\Requests\Admin\UpdateEquipmentRequest;
use App\Models\Equipment;
use App\Models\Trade;
use App\Services\EquipmentService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class EquipmentController extends Controller
{
    public function __construct(private readonly EquipmentService $equipment) {}

    public function index(): View
    {
        $this->authorize('viewAny', Equipment::class);

        return view('admin.equipment.index', [
            'equipment' => Equipment::query()->with('trades')->orderBy('position')->get(),
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Equipment::class);

        return view('admin.equipment.create', [
            'trades' => Trade::query()->orderBy('position')->get(),
        ]);
    }

    public function store(StoreEquipmentRequest $request): RedirectResponse
    {
        $this->equipment->create($request->safe()->except(['image', 'spec_sheet']), $request->file('image'), $request->file('spec_sheet'));

        return redirect()->route('admin.equipment.index')->with('status', 'Équipement créé.');
    }

    public function edit(Equipment $equipment): View
    {
        $this->authorize('update', $equipment);

        return view('admin.equipment.edit', [
            'item' => $equipment,
            'trades' => Trade::query()->orderBy('position')->get(),
            'selectedTradeIds' => $equipment->trades()->pluck('trades.id')->all(),
        ]);
    }

    public function update(UpdateEquipmentRequest $request, Equipment $equipment): RedirectResponse
    {
        $this->equipment->update($equipment, $request->safe()->except(['image', 'spec_sheet']), $request->file('image'), $request->file('spec_sheet'));

        return redirect()->route('admin.equipment.index')->with('status', 'Équipement mis à jour.');
    }

    public function destroy(Equipment $equipment): RedirectResponse
    {
        $this->authorize('delete', $equipment);

        $this->equipment->delete($equipment);

        return redirect()->route('admin.equipment.index')->with('status', 'Équipement supprimé.');
    }
}
