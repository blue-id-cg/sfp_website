<?php

namespace App\Services;

use App\Models\ContentBlock;

class ContentBlockService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): ContentBlock
    {
        $data['position'] ??= $this->nextPosition($data['group']);

        return ContentBlock::query()->create($data);
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(ContentBlock $contentBlock, array $data): ContentBlock
    {
        $contentBlock->update($data);

        return $contentBlock;
    }

    public function delete(ContentBlock $contentBlock): void
    {
        $contentBlock->delete();
    }

    private function nextPosition(string $group): int
    {
        return (int) (ContentBlock::query()->group($group)->max('position') ?? 0) + 1;
    }
}
