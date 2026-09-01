<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSiteSettingRequest;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    public function edit(): View
    {
        $setting = SiteSetting::current();

        $this->authorize('view', $setting);

        return view('admin.settings.edit', ['setting' => $setting]);
    }

    public function update(UpdateSiteSettingRequest $request): RedirectResponse
    {
        $setting = SiteSetting::current();

        $setting->update($request->validated());

        return redirect()->route('admin.settings.edit')->with('status', 'Réglages mis à jour.');
    }
}
