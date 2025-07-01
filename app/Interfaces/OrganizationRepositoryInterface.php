<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Transfers\OrganizationDto;
use App\Transfers\OrganizationWithBuildingDataDto;
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
     * @param bool $withBuilding
     * @return Collection<int, OrganizationDto>|Collection<int, OrganizationWithBuildingDataDto>
     */
    public function getOrganizationsByBuildingIds(array $buildingIds, bool $withBuilding = false): Collection;

    /**
     * @param int $businessId
     * @return Collection<int, OrganizationDto>
     */
    public function getOrganizationsByBusinessId(int $businessId): Collection;

    /**
     * @param int $id
     * @return OrganizationDto
     */
    public function getOrganizationsById(int $id): OrganizationDto;
}