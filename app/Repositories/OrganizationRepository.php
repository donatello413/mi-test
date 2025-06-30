<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\OrganizationRepositoryInterface;
use App\Models\Organization;
use App\Transfers\OrganizationDto;
use Illuminate\Support\Collection;

class OrganizationRepository implements OrganizationRepositoryInterface
{
    /**
     * @param int $buildingId
     * @return Collection<int, OrganizationDto>
     */
    public function getOrganizationsByBuildingId(int $buildingId): Collection
    {
        $organizations = Organization::query()->where('building_id', $buildingId)->get();

        if ($organizations->isEmpty()) {
            return collect();
        }

        return $organizations->map(fn(Organization $organization) => OrganizationDto::fromModel($organization));
    }

    public function getOrganizationsByBusinessId(int $businessId): Collection
    {
        $organizations = Organization::query()
            ->whereHas('businesses', function ($query) use ($businessId) {
                $query->where('business_id', $businessId);
            })
            ->get();

        return $organizations->map(fn(Organization $organization) => OrganizationDto::fromModel($organization));
    }
}