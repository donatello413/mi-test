<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Requests\OrganizationByGeoAreaRequest;
use App\Http\Resources\OrganizationsResource;
use App\Interfaces\OrganizationReaderInterface;
use App\Transfers\OrganizationDto;
use App\Transfers\OrganizationWithBuildingDataDto;
use Illuminate\Support\Collection;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\QueryParam;

#[Group("Organizations")]
#[Endpoint(
    title: "Получение организаций по географической области",
    description: "Получение списка организаций в заданной географической области (радиус или прямоугольник)",
    authenticated: false,
)]
final readonly class GetOrganizationsByGeoAreaAction
{
    public function __construct(
        public OrganizationReaderInterface $organizationReader,
    ) {
    }

    #[QueryParam(name: "radius", type: "numeric", description: "Радиус поиска в метрах", required: false, example: "1000")]
    #[QueryParam(name: "latitude1", type: "numeric", description: "Широта первой точки", required: true, example: "55.7558")]
    #[QueryParam(name: "longitude1", type: "numeric", description: "Долгота первой точки", required: true, example: "37.6173")]
    #[QueryParam(name: "latitude2", type: "numeric", description: "Широта второй точки", required: false, example: "55.7512")]
    #[QueryParam(name: "longitude2", type: "numeric", description: "Долгота второй точки", required: false, example: "37.6225")]
    #[QueryParam(name: "latitude3", type: "numeric", description: "Широта третьей точки", required: false, example: "55.7532")]
    #[QueryParam(name: "longitude3", type: "numeric", description: "Долгота третьей точки", required: false, example: "37.6189")]
    #[QueryParam(name: "latitude4", type: "numeric", description: "Широта четвертой точки", required: false, example: "55.7544")]
    #[QueryParam(name: "longitude4", type: "numeric", description: "Долгота четвертой точки", required: false, example: "37.6200")]
    public function __invoke(OrganizationByGeoAreaRequest $request): OrganizationsResource
    {
        /** @var Collection<int, OrganizationDto>|Collection<int, OrganizationWithBuildingDataDto> $result */
        $result = $this->organizationReader->getOrganizationsByGeoArea(
            requestDto: $request->toDto($request),
            withBuilding: true
        );

        return new OrganizationsResource($result);
    }
}