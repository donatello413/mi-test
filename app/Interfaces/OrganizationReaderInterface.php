<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Transfers\OrganizationDto;
use App\Transfers\OrganizationsByBuildingRequestDto;
use App\Transfers\OrganizationsByBusinessRequestDto;
use App\Transfers\OrganizationsByGeoAreaRequestDto;
use Illuminate\Support\Collection;

interface OrganizationReaderInterface
{
    /**
     * @param OrganizationsByBuildingRequestDto $requestDto
     * @return Collection<int, OrganizationDto>
     */
    public function getOrganizationsByBuilding(OrganizationsByBuildingRequestDto $requestDto): Collection;

    /**
     * @param OrganizationsByBusinessRequestDto $requestDto
     * @return Collection<int, OrganizationDto>
     */
    public function getOrganizationsByBusiness(OrganizationsByBusinessRequestDto $requestDto): Collection;

    /**
     * @param OrganizationsByGeoAreaRequestDto $requestDto
     * @param bool $withBuilding
     * @return Collection<int, OrganizationDto>
     */
    public function getOrganizationsByGeoArea(OrganizationsByGeoAreaRequestDto $requestDto, bool $withBuilding = false): Collection;

    /**
     * @param int $id
     * @return OrganizationDto
     */
    public function getOrganizationsById(int $id): OrganizationDto;
}