<?php

declare(strict_types=1);

namespace App\Transfers;

use App\Models\Business;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

final class BusinessDto extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $slug,
        public int $parentId,
        public Collection $children = new Collection(),
    ) {
    }

    public static function fromArray(array $data): self
    {
        $validatedData = self::validate($data);

        return new self(
            id: $validatedData['id'] ?? null,
            name: $validatedData['name'],
            slug: $validatedData['slug'],
            parentId: $validatedData['parent_id'],
            children: $validatedData['children'] ?? new Collection(),
        );
    }

    public static function fromModel(Business $model): self
    {
        return new self(
            id: $model->id,
            name: $model->name,
            slug: $model->slug,
            parentId: $model->parent_id,
            children: $model->children,
        );
    }
}
