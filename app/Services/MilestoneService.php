<?php

namespace App\Services;

use App\Models\Milestone;

class MilestoneService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Milestone
    {
        $data['position'] ??= $this->nextPosition();

        return Milestone::query()->create($data);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Milestone $milestone, array $data): Milestone
    {
        $milestone->update($data);

        return $milestone;
    }

    public function delete(Milestone $milestone): void
    {
        $milestone->delete();
    }

    private function nextPosition(): int
    {
        return (int) (Milestone::query()->max('position') ?? 0) + 1;
    }
}
