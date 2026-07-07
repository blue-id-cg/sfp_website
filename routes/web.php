<?php

use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\CarriereController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\SeoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/actualites', [ActualiteController::class, 'index'])->name('actualites.index');
Route::get('/actualites/{actualite}', [ActualiteController::class, 'show'])->name('actualites.show');

Route::get('/carrieres', [CarriereController::class, 'index'])->name('carrieres.index');
Route::get('/carrieres/offres/{offre}', [OffreController::class, 'show'])->name('offres.show');

Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
