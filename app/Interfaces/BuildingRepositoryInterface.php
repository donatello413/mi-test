<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Transfers\BuildingDto;

interface BuildingRepositoryInterface
{
    /**
     * @param string $address
     * @return BuildingDto
     */
    public function getBuildingByAddress(string $address): BuildingDto;
}