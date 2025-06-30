<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Transfers\OrganizationsByGeoAreaRequestDto;
use Illuminate\Foundation\Http\FormRequest;

class OrganizationByGeoAreaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            
        ];
    }

    public function toDto(self $request): OrganizationsByGeoAreaRequestDto
    {
        /** @var string[] $validated */
        $validated = $request->validated();

        return new OrganizationsByGeoAreaRequestDto(
        );
    }
}
