<?php

declare(strict_types=1);

namespace App\Transfers;

use App\Models\Organization;
use Spatie\LaravelData\Data;

final class OrganizationWithBuildingDataDto extends Data
{
    public function __construct(
        public OrganizationDto $organizationDto,
        public BuildingDto $buildingDto,
    ) {
    }

    public static function fromArray(array $data): self
    {
        $validatedData = self::validate($data);

        return new self(
            organizationDto: OrganizationDto::fromArray($validatedData['organization']),
            buildingDto: BuildingDto::fromArray($validatedData['building']),
        );
    }

    public static function fromModel(Organization $model): self
    {
        return new self(
            organizationDto: OrganizationDto::fromModel($model),
            buildingDto: BuildingDto::fromModel($model->building),
        );
    }
}
