<?php

declare(strict_types=1);

namespace App\Transfers;

use App\Models\Organization;
use Spatie\LaravelData\Data;

final class OrganizationDto extends Data
{
    public function __construct(
        public ?int $id,
        public string $name,
        public string $slug,
        public array $phones,
        public ?int $buildingId,
    ) {
    }

    public static function fromArray(array $data): self
    {
        $validatedData = self::validate($data);

        return new self(
            id: $validatedData['id'] ?? null,
            name: $validatedData['name'],
            slug: $validatedData['slug'],
            phones: $validatedData['phones'],
            buildingId: $validatedData['building_id'] ?? null,
        );
    }

    public static function fromModel(Organization $model): self
    {
        return new self(
            id: $model->id,
            name: $model->name,
            slug: $model->slug,
            phones: $model->phones,
            buildingId: $model->building_id
        );
    }
}
