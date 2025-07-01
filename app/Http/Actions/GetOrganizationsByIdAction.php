<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Resources\OrganizationResource;
use App\Interfaces\OrganizationReaderInterface;
use App\Transfers\OrganizationDto;
use Illuminate\Support\Collection;

final readonly class GetOrganizationsByIdAction
{
    public function __construct(
        public OrganizationReaderInterface $organizationReader,
    ) {
    }

    public function __invoke(int $id): OrganizationResource
    {
        /** @var Collection<int, OrganizationDto> $result */
        $result = $this->organizationReader->getOrganizationsById($id);

        return new OrganizationResource($result);
    }
}