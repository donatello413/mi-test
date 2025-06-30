<?php

declare(strict_types=1);

namespace App\Reader;

use App\Interfaces\BuildingRepositoryInterface;
use App\Interfaces\BusinessRepositoryInterface;
use App\Interfaces\OrganizationReaderInterface;
use App\Interfaces\OrganizationRepositoryInterface;
use App\Transfers\OrganizationDto;
use App\Transfers\OrganizationsByBuildingRequestDto;
use App\Transfers\OrganizationsByBusinessRequestDto;
use Illuminate\Support\Collection;

class OrganizationReader implements OrganizationReaderInterface
{
    public function __construct(
        protected OrganizationRepositoryInterface $organizationRepository,
        protected BusinessRepositoryInterface $businessRepository,
        protected BuildingRepositoryInterface $buildingRepository,
    ) {
    }

    /**
     * @param OrganizationsByBuildingRequestDto $requestDto
     * @return Collection<int, OrganizationDto>
     */
    public function getOrganizationsByBuildingAction(OrganizationsByBuildingRequestDto $requestDto): Collection
    {
        $building = $this->buildingRepository->getBuildingByAddress($requestDto->address);

        return $this->organizationRepository->getOrganizationsByBuildingId($building->id);
    }

    /**
     * @param OrganizationsByBusinessRequestDto $requestDto
     * @return Collection<int, OrganizationDto>
     */
    public function getOrganizationsByBusinessAction(OrganizationsByBusinessRequestDto $requestDto): Collection
    {
        $business = $this->businessRepository->getBusinessBySlug($requestDto->slug);

        return $this->organizationRepository->getOrganizationsByBusinessId($business->id);
    }
}