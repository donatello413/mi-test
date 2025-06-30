<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Requests\OrganizationByGeoAreaRequest;
use App\Http\Resources\OrganizationResource;
use App\Interfaces\OrganizationReaderInterface;
use App\Transfers\OrganizationDto;
use Illuminate\Support\Collection;

final readonly class GetOrganizationsByGeoAreaAction
{
    public function __construct(
        public OrganizationReaderInterface $organizationReader,
    ) {
    }

    public function __invoke(OrganizationByGeoAreaRequest $request): OrganizationResource
    {
        /** @var Collection<int, OrganizationDto> $result */
        $result = $this->organizationReader->getOrganizationsByGeoArea(requestDto: $request->toDto($request));

        return new OrganizationResource($result);
    }
}