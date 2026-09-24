<?php

namespace App\Services;

use App\Models\Trade;

class TradeService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): Trade
    {
        $data['position'] ??= $this->nextPosition();

        return Trade::query()->create($data);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(Trade $trade, array $data): Trade
    {
        $trade->update($data);

        return $trade;
    }

    public function delete(Trade $trade): void
    {
        $trade->delete();
    }

    private function nextPosition(): int
    {
        return (int) (Trade::query()->max('position') ?? 0) + 1;
    }
}
