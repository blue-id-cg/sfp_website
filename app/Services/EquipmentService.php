<?php

namespace App\Services;

use App\Models\Equipment;
use Illuminate\Http\UploadedFile;

class EquipmentService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data, ?UploadedFile $image = null, ?UploadedFile $specSheet = null): Equipment
    {
        $data['position'] ??= $this->nextPosition();

        if ($image !== null) {
            $data['image'] = $image->store('equipment', 'public');
        }

        if ($specSheet !== null) {
            $data['spec_sheet'] = $specSheet->store('equipment/spec-sheets', 'public');
        }

        $trades = $data['trades'] ?? [];
        unset($data['trades']);

        $equipment = Equipment::query()->create($data);
        $equipment->trades()->sync($trades);

        return $equipment;
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Equipment $equipment, array $data, ?UploadedFile $image = null, ?UploadedFile $specSheet = null): Equipment
    {
        if ($image !== null) {
            $data['image'] = $image->store('equipment', 'public');
        }

        if ($specSheet !== null) {
            $data['spec_sheet'] = $specSheet->store('equipment/spec-sheets', 'public');
        }

        $trades = $data['trades'] ?? [];
        unset($data['trades']);

        $equipment->update($data);
        $equipment->trades()->sync($trades);

        return $equipment;
    }

    public function delete(Equipment $equipment): void
    {
        $equipment->delete();
    }

    private function nextPosition(): int
    {
        return (int) (Equipment::query()->max('position') ?? 0) + 1;
    }
}
