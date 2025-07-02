<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Requests\OrganizationsByBuildingRequest;
use App\Http\Resources\OrganizationsResource;
use App\Interfaces\OrganizationReaderInterface;
use App\Transfers\OrganizationDto;
use Illuminate\Support\Collection;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\QueryParam;

#[Group("Organizations")]
#[Endpoint(
    title: "Получение организаций по зданию",
    description: "Получение списка организаций, находящихся в указанном здании",
    authenticated: false,
)]
final readonly class GetOrganizationsByBuildingAction
{
    public function __construct(
        public OrganizationReaderInterface $organizationReader,
    ) {
    }

    #[QueryParam(name: "address", type: "string", description: "Адрес здания", required: true, example: "71873 Carrie Plains")]
    public function __invoke(OrganizationsByBuildingRequest $request): OrganizationsResource
    {
        /** @var Collection<int, OrganizationDto> $result */
        $result = $this->organizationReader->getOrganizationsByBuilding(requestDto: $request->toDto($request));

        return new OrganizationsResource($result);
    }
}