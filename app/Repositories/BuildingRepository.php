<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\BuildingRepositoryInterface;
use App\Models\Building;
use App\Transfers\BuildingDto;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BuildingRepository implements BuildingRepositoryInterface
{
    public function getBuildingByAddress(string $address): BuildingDto
    {
        $building = Building::query()->where('address', $address)->first();

        if ($building === null) {
            throw new ModelNotFoundException("Building with address '{$address}' not found");
        }

        return BuildingDto::fromModel($building);
    }
}