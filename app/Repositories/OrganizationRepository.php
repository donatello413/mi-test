<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\OrganizationRepositoryInterface;
use App\Models\Organization;
use App\Transfers\BuildingDto;
use App\Transfers\OrganizationDto;
use App\Transfers\OrganizationWithBuildingDataDto;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class OrganizationRepository implements OrganizationRepositoryInterface
{
    /**
     * @param int $buildingId
     * @return Collection<int, OrganizationDto>
     */
    public function getOrganizationsByBuildingId(int $buildingId): Collection
    {
        $organizations = Organization::query()
            ->where('building_id', $buildingId)
            ->orderBy('id')
            ->get();

        if ($organizations->isEmpty()) {
            return collect();
        }

        return $organizations->map(fn(Organization $organization) => OrganizationDto::fromModel($organization));
    }

    /**
     * @param array $buildingIds
     * @param bool $withBuilding
     * @return Collection<int, OrganizationDto>|Collection<int, OrganizationWithBuildingDataDto>
     */
    public function getOrganizationsByBuildingIds(array $buildingIds, bool $withBuilding = false): Collection
    {
        $query = Organization::query();

        if ($withBuilding) {
            $query->with('building');
        }

        $organizations = $query->whereIn('building_id', $buildingIds)
            ->orderBy('id')
            ->get();


        if ($organizations->isEmpty()) {
            return collect();
        }

        return $organizations->map(
            fn(Organization $organization) => $this->mapToOrganizationDto($organization, $withBuilding)
        );
    }

    /**
     * @param int $businessId
     * @return Collection<int, OrganizationDto>
     */
    public function getOrganizationsByBusinessId(int $businessId): Collection
    {
        $organizations = Organization::query()
            ->whereHas('businesses', function ($query) use ($businessId) {
                $query->where('business_id', $businessId);
            })
            ->orderBy('id')
            ->get();

        return $organizations->map(fn(Organization $organization) => OrganizationDto::fromModel($organization));
    }

    /**
     * @param int $id
     * @return OrganizationDto
     */
    public function getOrganizationsById(int $id): OrganizationDto
    {
        $organizations = Organization::query()->find($id);
        
        if ($organizations === null) {
            throw new ModelNotFoundException("Organization with id '{$id}' not found");
        }

        return OrganizationDto::fromModel($organizations);
    }

    /**
     * @param Organization $organization
     * @param bool $withBuildingDto
     * @return OrganizationWithBuildingDataDto|OrganizationDto
     */
    private function mapToOrganizationDto(
        Organization $organization,
        bool $withBuildingDto
    ): OrganizationWithBuildingDataDto|OrganizationDto {
        if (
            $withBuildingDto &&
            $organization->building &&
            $organization->relationLoaded('building')
        ) {
            return OrganizationWithBuildingDataDto::fromModel(model: $organization);
        }

        return OrganizationDto::fromModel($organization);
    }
}
