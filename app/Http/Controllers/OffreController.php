<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use Illuminate\View\View;

class OffreController extends Controller
{
    public function show(Offre $offre): View
    {
        abort_unless($offre->published_at?->lessThanOrEqualTo(now()), 404);

        return view('offres.show', [
            'offre' => $offre,
        ]);
    }
}
