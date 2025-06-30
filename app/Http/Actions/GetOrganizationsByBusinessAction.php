<?php

namespace App\Http\Actions;

use App\Http\Requests\OrganizationsByBusinessRequest;
use App\Http\Resources\OrganizationResource;
use App\Interfaces\OrganizationReaderInterface;
use App\Transfers\OrganizationDto;
use Illuminate\Support\Collection;

final readonly class GetOrganizationsByBusinessAction
{
    public function __construct(
        public OrganizationReaderInterface $organizationReader,
    ) {
    }

    public function __invoke(OrganizationsByBusinessRequest $request): OrganizationResource
    {
        /** @var Collection<int, OrganizationDto> $result */
        $result = $this->organizationReader->getOrganizationsByBusinessAction(requestDto: $request->toDto($request));

        return new OrganizationResource($result);
    }
}