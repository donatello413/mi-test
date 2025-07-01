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
     * @return Collection<int, OrganizationDto>
     */
    public function getOrganizationsByBuilding(OrganizationsByBuildingRequestDto $requestDto): Collection;

    /**
     * @return Collection<int, OrganizationDto>
     */
    public function getOrganizationsByBusiness(OrganizationsByBusinessRequestDto $requestDto): Collection;

    /**
     * @return Collection<int, OrganizationDto>
     */
    public function getOrganizationsByGeoArea(OrganizationsByGeoAreaRequestDto $requestDto): Collection;
}