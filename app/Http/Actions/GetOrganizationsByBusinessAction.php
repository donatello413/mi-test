<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Requests\OrganizationsByBusinessRequest;
use App\Http\Resources\OrganizationsResource;
use App\Interfaces\OrganizationReaderInterface;
use App\Transfers\OrganizationDto;
use Illuminate\Support\Collection;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\QueryParam;

#[Group("Organizations")]
#[Endpoint(
    title: "Получение организаций по бизнесу",
    description: "Получение списка организаций, относящихся к указанному бизнесу",
    authenticated: false,
)]
final readonly class GetOrganizationsByBusinessAction
{
    public function __construct(
        public OrganizationReaderInterface $organizationReader,
    ) {
    }

    #[QueryParam(name: "slug", type: "string", description: "Slug бизнеса", required: true, example: "some-business-slug")]
    public function __invoke(OrganizationsByBusinessRequest $request): OrganizationsResource
    {
        /** @var Collection<int, OrganizationDto> $result */
        $result = $this->organizationReader->getOrganizationsByBusiness(requestDto: $request->toDto($request));

        return new OrganizationsResource($result);
    }
}