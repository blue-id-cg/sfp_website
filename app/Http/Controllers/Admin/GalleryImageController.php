<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGalleryImageRequest;
use App\Http\Requests\Admin\UpdateGalleryImageRequest;
use App\Models\GalleryImage;
use App\Services\GalleryImageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GalleryImageController extends Controller
{
    public function __construct(private readonly GalleryImageService $galleryImages) {}

    public function index(): View
    {
        $this->authorize('viewAny', GalleryImage::class);

        return view('admin.gallery.index', [
            'images' => GalleryImage::query()->orderBy('position')->paginate(24),
        ]);
    }

    public function create(): View
    {
        $this->authorize('create', GalleryImage::class);

        return view('admin.gallery.create');
    }

    public function store(StoreGalleryImageRequest $request): RedirectResponse
    {
        $this->galleryImages->create($request->safe()->except('image'), $request->file('image'));

        return redirect()->route('admin.gallery.index')->with('status', 'Image ajoutée à la galerie.');
    }

    public function edit(GalleryImage $gallery): View
    {
        $this->authorize('update', $gallery);

        return view('admin.gallery.edit', ['image' => $gallery]);
    }

    public function update(UpdateGalleryImageRequest $request, GalleryImage $gallery): RedirectResponse
    {
        $this->galleryImages->update($gallery, $request->safe()->except('image'), $request->file('image'));

        return redirect()->route('admin.gallery.index')->with('status', 'Image mise à jour.');
    }

    public function destroy(GalleryImage $gallery): RedirectResponse
    {
        $this->authorize('delete', $gallery);

        $this->galleryImages->delete($gallery);

        return redirect()->route('admin.gallery.index')->with('status', 'Image supprimée.');
    }
}
