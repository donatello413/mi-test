<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Requests\OrganizationsByBuildingRequest;
use App\Http\Resources\OrganizationResource;
use App\Interfaces\OrganizationReaderInterface;
use App\Transfers\OrganizationDto;
use Illuminate\Support\Collection;

final readonly class GetOrganizationsByBuildingAction
{
    public function __construct(
        public OrganizationReaderInterface $organizationReader,
    ) {
    }

    public function __invoke(OrganizationsByBuildingRequest $request): OrganizationResource
    {
        /** @var Collection<int, OrganizationDto> $result */
        $result = $this->organizationReader->getOrganizationsByBuilding(requestDto: $request->toDto($request));

        return new OrganizationResource($result);
    }
}