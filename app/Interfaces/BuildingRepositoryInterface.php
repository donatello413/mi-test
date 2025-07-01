<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Transfers\BuildingDto;
use Illuminate\Support\Collection;

interface BuildingRepositoryInterface
{
    /**
     * @param string $address
     * @return BuildingDto
     */
    public function getBuildingByAddress(string $address): BuildingDto;

    /**
     * @param float $latitude
     * @param float $longitude
     * @param float $radius
     * @return Collection<int, BuildingDto>
     */
    public function getBuildingIdsByRadius(float $latitude, float $longitude, float $radius): Collection;

    /**
     * @param array<> $points
     * @return Collection<int, BuildingDto>
     */
    public function getBuildingIdsByBoundingBox(array $points): Collection;
}