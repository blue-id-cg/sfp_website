<?php

namespace App\Http\Controllers;

use App\Support\Content\Offres;
use Illuminate\View\View;

class OffreController extends Controller
{
    public function show(string $offre): View
    {
        $job = Offres::findBySlug($offre);

        abort_if($job === null, 404);

        return view('offres.show', [
            'offre' => $job,
        ]);
    }
}
