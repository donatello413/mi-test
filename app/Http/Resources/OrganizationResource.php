<?php

namespace App\Http\Resources;

use App\Transfers\OrganizationDto;
use App\Transfers\OrganizationWithBuildingDataDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;
use RuntimeException;

class OrganizationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Collection<int, OrganizationDto>|Collection<int, OrganizationWithBuildingDataDto> $result */
        $result = $this->resource;

        return $result->map(function ($item) {
            if ($item instanceof OrganizationWithBuildingDataDto) {
                return [
                    'id' => $item->organizationDto->id,
                    'name' => $item->organizationDto->name,
                    'slug' => $item->organizationDto->slug,
                    'phones' => $item->organizationDto->phones,
                    'building' => [
                        'id' => $item->buildingDto->id,
                        'address' => $item->buildingDto->address,
                        'latitude' => $item->buildingDto->latitude,
                        'longitude' => $item->buildingDto->longitude,
                    ],
                ];
            }

            if ($item instanceof OrganizationDto) {
                return [
                    'id' => $item->id,
                    'name' => $item->name,
                    'slug' => $item->slug,
                    'phones' => $item->phones,
                ];
            }

            throw new RuntimeException('Unexpected DTO type: ' . get_class($item));
        })->toArray();
    }
}
