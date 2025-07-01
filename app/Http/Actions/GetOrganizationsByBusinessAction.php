<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Requests\OrganizationsByBusinessRequest;
use App\Http\Resources\OrganizationsResource;
use App\Interfaces\OrganizationReaderInterface;
use App\Transfers\OrganizationDto;
use Illuminate\Support\Collection;

final readonly class GetOrganizationsByBusinessAction
{
    public function __construct(
        public OrganizationReaderInterface $organizationReader,
    ) {
    }

    public function __invoke(OrganizationsByBusinessRequest $request): OrganizationsResource
    {
        /** @var Collection<int, OrganizationDto> $result */
        $result = $this->organizationReader->getOrganizationsByBusiness(requestDto: $request->toDto($request));

        return new OrganizationsResource($result);
    }
}