<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Resources\OrganizationResource;
use App\Interfaces\OrganizationReaderInterface;
use App\Transfers\OrganizationDto;
use Illuminate\Support\Collection;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\UrlParam;

#[Group("Organization")]
#[Endpoint(
    title: "Получение организации по идентификатору",
    description: "Получение организации по её идентификатору",
    authenticated: false,
)]
final readonly class GetOrganizationsByIdAction
{
    public function __construct(
        public OrganizationReaderInterface $organizationReader,
    ) {
    }

    #[UrlParam(name: 'id', description: 'Идентификатор организации', example: 1)]
    public function __invoke(int $id): OrganizationResource
    {
        $result = $this->organizationReader->getOrganizationsById($id);

        return new OrganizationResource($result);
    }
}