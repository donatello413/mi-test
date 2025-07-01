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
use App\Transfers\OrganizationsByGeoAreaRequestDto;
use App\Transfers\OrganizationWithBuildingDataDto;
use Illuminate\Support\Collection;
use InvalidArgumentException;

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
    public function getOrganizationsByBuilding(OrganizationsByBuildingRequestDto $requestDto): Collection
    {
        $building = $this->buildingRepository->getBuildingByAddress($requestDto->address);

        return $this->organizationRepository->getOrganizationsByBuildingId($building->id);
    }

    /**
     * @param OrganizationsByBusinessRequestDto $requestDto
     * @return Collection<int, OrganizationDto>
     */
    public function getOrganizationsByBusiness(OrganizationsByBusinessRequestDto $requestDto): Collection
    {
        $business = $this->businessRepository->getBusinessBySlug($requestDto->slug);

        return $this->organizationRepository->getOrganizationsByBusinessId($business->id);
    }

    /**
     * @param OrganizationsByGeoAreaRequestDto $requestDto
     * @param bool $withBuilding
     * @return Collection<int, OrganizationDto>|Collection<int, OrganizationWithBuildingDataDto>
     */
    public function getOrganizationsByGeoArea(
        OrganizationsByGeoAreaRequestDto $requestDto,
        bool $withBuilding = false
    ): Collection {
        if ($requestDto->radius !== null) {
            $buildings = $this->buildingRepository->getBuildingIdsByRadius(
                latitude: $requestDto->latitude1,
                longitude: $requestDto->longitude1,
                radius: $requestDto->radius
            );
        } elseif (count($requestDto->getPoints()) > 0) {
            $buildings = $this->buildingRepository->getBuildingIdsByBoundingBox($requestDto->getPoints());
        } else {
            throw new InvalidArgumentException(message: 'Either radius or bounding box coordinates must be provided');
        }

        /** @var int[] $buildingIds */
        $buildingIds = $buildings->pluck('id')->toArray();

        return $this->organizationRepository->getOrganizationsByBuildingIds(
            buildingIds: $buildingIds,
            withBuilding: $withBuilding
        );
    }
}