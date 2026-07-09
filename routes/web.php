<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ActualiteController;
use App\Http\Controllers\Admin\ActualiteController as AdminActualiteController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryImageController as AdminGalleryImageController;
use App\Http\Controllers\Admin\OffreController as AdminOffreController;
use App\Http\Controllers\CarriereController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HseController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\MetierController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/a-propos', [AboutController::class, 'index'])->name('about.index');
Route::get('/metiers', [MetierController::class, 'index'])->name('metiers.index');
Route::get('/hse', [HseController::class, 'index'])->name('hse.index');
Route::get('/equipements', [EquipementController::class, 'index'])->name('equipements.index');

Route::get('/mentions-legales', [LegalController::class, 'mentions'])->name('legal.mentions');
Route::get('/politique-de-confidentialite', [LegalController::class, 'privacy'])->name('legal.privacy');
Route::get('/cookies', [LegalController::class, 'cookies'])->name('legal.cookies');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/actualites', [ActualiteController::class, 'index'])->name('actualites.index');
Route::get('/actualites/{actualite}', [ActualiteController::class, 'show'])->name('actualites.show');

Route::get('/carrieres', [CarriereController::class, 'index'])->name('carrieres.index');
Route::get('/carrieres/offres/{offre}', [OffreController::class, 'show'])->name('offres.show');

Route::get('/galerie', [GalleryController::class, 'index'])->name('galerie.index');

Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('actualites', AdminActualiteController::class)->except('show');
    Route::resource('offres', AdminOffreController::class)->except('show');
    Route::resource('gallery', AdminGalleryImageController::class)->except('show');
    Route::resource('messages', AdminContactMessageController::class)->only(['index', 'show', 'destroy']);
});

require __DIR__.'/auth.php';
