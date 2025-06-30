<?php

declare(strict_types=1);

namespace App\Transfers;

use App\Models\Building;
use Spatie\LaravelData\Data;

final class BuildingDto extends Data
{
    public function __construct(
        public ?int $id,
        public string $address,
        public float|string $latitude,
        public float|string $longitude,
    ) {
    }

    public static function fromArray(array $data): self
    {
        $validatedData = self::validate($data);

        return new self(
            id: $validatedData['id'] ?? null,
            address: $validatedData['address'],
            latitude: $validatedData['latitude'],
            longitude: $validatedData['longitude'],
        );
    }

    public static function fromModel(Building $model): self
    {
        return new self(
            id: $model->id,
            address: $model->address,
            latitude: $model->latitude,
            longitude: $model->longitude
        );
    }
}
