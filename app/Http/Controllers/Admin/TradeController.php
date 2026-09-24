<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTradeRequest;
use App\Http\Requests\Admin\UpdateTradeRequest;
use App\Models\Trade;
use App\Services\TradeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TradeController extends Controller
{
    public function __construct(private readonly TradeService $trades) {}

    public function index(): View
    {
        $this->authorize('viewAny', Trade::class);

        return view('admin.trades.index', [
            'trades' => Trade::query()->orderBy('position')->get(),
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', Trade::class);

        return view('admin.trades.create');
    }

    public function store(StoreTradeRequest $request): RedirectResponse
    {
        $this->trades->create($request->validated());

        return redirect()->route('admin.trades.index')->with('status', 'Métier créé.');
    }

    public function edit(Trade $trade): View
    {
        $this->authorize('update', $trade);

        return view('admin.trades.edit', ['trade' => $trade]);
    }

    public function update(UpdateTradeRequest $request, Trade $trade): RedirectResponse
    {
        $this->trades->update($trade, $request->validated());

        return redirect()->route('admin.trades.index')->with('status', 'Métier mis à jour.');
    }

    public function destroy(Trade $trade): RedirectResponse
    {
        $this->authorize('delete', $trade);

        $this->trades->delete($trade);

        return redirect()->route('admin.trades.index')->with('status', 'Métier supprimé.');
    }
}
