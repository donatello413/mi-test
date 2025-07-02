<?php

declare(strict_types=1);

namespace App\Http\Actions;

use App\Http\Resources\OrganizationResource;
use App\Interfaces\OrganizationReaderInterface;
use Knuckles\Scribe\Attributes\Endpoint;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\UrlParam;

#[Group("Organization")]
#[Endpoint(
    title: "Получение организации по наименованию",
    description: "Получение организации по её наименованию",
    authenticated: false,
)]
final readonly class GetOrganizationsByNameAction
{
    public function __construct(
        public OrganizationReaderInterface $organizationReader,
    ) {
    }

    #[UrlParam(name: 'name', description: 'Наименование организации', example: 'ratke')]
    public function __invoke(string $name): OrganizationResource
    {
        $result = $this->organizationReader->getOrganizationsByName($name);

        return new OrganizationResource($result);
    }
}