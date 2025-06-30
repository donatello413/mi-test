<?php

declare(strict_types=1);

namespace App\Interfaces;

use App\Transfers\OrganizationDto;
use App\Transfers\OrganizationsByBuildingRequestDto;
use App\Transfers\OrganizationsByBusinessRequestDto;
use Illuminate\Support\Collection;

interface OrganizationReaderInterface
{
    /**
     * @return Collection<int, OrganizationDto>
     */
    public function getOrganizationsByBuildingAction(OrganizationsByBuildingRequestDto $requestDto): Collection;

    /**
     * @return Collection<int, OrganizationDto>
     */
    public function getOrganizationsByBusinessAction(OrganizationsByBusinessRequestDto $requestDto): Collection;
}