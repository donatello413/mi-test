<?php

namespace App\Http\Resources;

use App\Transfers\OrganizationDto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class OrganizationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        /** @var Collection<int, OrganizationDto> $result */
        $result = $this->resource;

        return $result->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'slug' => $item->slug,
                'phones' => $item->phones,
            ];
        })->toArray();
    }
}
