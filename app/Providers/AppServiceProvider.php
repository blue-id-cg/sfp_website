<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Paginator::defaultView('vendor.pagination.site');

        Model::preventLazyLoading(! $this->app->isProduction());

        // Contact details & key figures needed by the footer and legal pages on every request,
        // regardless of which controller rendered the page.
        View::composer(['partials.footer', 'legal.*', 'layouts.app'], function ($view): void {
            $view->with('settings', SiteSetting::current());
        });
    }
}
