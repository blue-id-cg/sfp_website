<?php

namespace App\Services;

use App\Models\Equipment;
use App\Support\ImageOptimizer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class EquipmentService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data, ?UploadedFile $image = null, ?UploadedFile $specSheet = null): Equipment
    {
        $data['position'] ??= $this->nextPosition();

        if ($image !== null) {
            $data['image'] = (new ImageOptimizer)->store($image, 'equipment');
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
            $oldImage = $equipment->image;
            $data['image'] = (new ImageOptimizer)->store($image, 'equipment');
            if ($oldImage !== null) {
                Storage::disk('public')->delete($oldImage);
            }
        }

        if ($specSheet !== null) {
            $oldSpecSheet = $equipment->spec_sheet;
            $data['spec_sheet'] = $specSheet->store('equipment/spec-sheets', 'public');
            if ($oldSpecSheet !== null) {
                Storage::disk('public')->delete($oldSpecSheet);
            }
        }

        $trades = $data['trades'] ?? [];
        unset($data['trades']);

        $equipment->update($data);
        $equipment->trades()->sync($trades);

        return $equipment;
    }

    public function delete(Equipment $equipment): void
    {
        if ($equipment->image !== null) {
            Storage::disk('public')->delete($equipment->image);
        }

        if ($equipment->spec_sheet !== null) {
            Storage::disk('public')->delete($equipment->spec_sheet);
        }

        $equipment->delete();
    }

    private function nextPosition(): int
    {
        return (int) (Equipment::query()->max('position') ?? 0) + 1;
    }
}
