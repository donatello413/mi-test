<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Transfers\OrganizationDto;
use Illuminate\Support\Collection;

interface OrganizationRepositoryInterface
{
    /**
     * @param int $buildingId
     * @return Collection<int, OrganizationDto>
     */
    public function getOrganizationsByBuildingId(int $buildingId): Collection;

    /**
     * @param array $buildingIds
     * @return Collection<int, OrganizationDto>
     */
    public function getOrganizationsByBuildingIds(array $buildingIds): Collection;

    /**
     * @param int $businessId
     * @return Collection<int, OrganizationDto>
     */
    public function getOrganizationsByBusinessId(int $businessId): Collection;
}