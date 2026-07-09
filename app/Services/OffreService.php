<?php

namespace App\Services;

use App\Models\Offre;

class OffreService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Offre
    {
        return Offre::query()->create($data);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Offre $offre, array $data): Offre
    {
        $offre->update($data);

        return $offre;
    }

    public function delete(Offre $offre): void
    {
        $offre->delete();
    }
}
