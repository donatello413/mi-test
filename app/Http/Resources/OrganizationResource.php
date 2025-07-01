<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Transfers\OrganizationDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var OrganizationDto $result */
        $result = $this->resource;

        return [
            'id' => $result->id,
            'name' => $result->name,
            'slug' => $result->slug,
            'phones' => $result->phones
        ];
    }
}
