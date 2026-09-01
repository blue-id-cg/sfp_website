<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreContentBlockRequest;
use App\Http\Requests\Admin\UpdateContentBlockRequest;
use App\Models\ContentBlock;
use App\Services\ContentBlockService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContentBlockController extends Controller
{
    public function __construct(private readonly ContentBlockService $contentBlocks) {}

    public function index(Request $request): View
    {
        $this->authorize('viewAny', ContentBlock::class);

        $group = $request->string('group')->trim()->toString();

        return view('admin.content-blocks.index', [
            'blocksByGroup' => ContentBlock::query()
                ->when($group !== '', fn ($query) => $query->group($group))
                ->orderBy('group')
                ->orderBy('position')
                ->get()
                ->groupBy('group'),
            'groups' => array_keys(ContentBlock::GROUP_LABELS),
            'selectedGroup' => $group,
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', ContentBlock::class);

        return view('admin.content-blocks.create', [
            'groups' => array_keys(ContentBlock::GROUP_LABELS),
        ]);
    }

    public function store(StoreContentBlockRequest $request): RedirectResponse
    {
        $this->contentBlocks->create($request->validated());

        return redirect()->route('admin.content-blocks.index')->with('status', 'Bloc de contenu créé.');
    }

    public function edit(ContentBlock $contentBlock): View
    {
        $this->authorize('update', $contentBlock);

        return view('admin.content-blocks.edit', [
            'block' => $contentBlock,
            'groups' => array_keys(ContentBlock::GROUP_LABELS),
        ]);
    }

    public function update(UpdateContentBlockRequest $request, ContentBlock $contentBlock): RedirectResponse
    {
        $this->contentBlocks->update($contentBlock, $request->validated());

        return redirect()->route('admin.content-blocks.index')->with('status', 'Bloc de contenu mis à jour.');
    }

    public function destroy(ContentBlock $contentBlock): RedirectResponse
    {
        $this->authorize('delete', $contentBlock);

        $this->contentBlocks->delete($contentBlock);

        return redirect()->route('admin.content-blocks.index')->with('status', 'Bloc de contenu supprimé.');
    }
}
