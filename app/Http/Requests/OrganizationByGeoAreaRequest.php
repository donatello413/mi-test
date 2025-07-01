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
            'radius' => 'nullable|numeric|min:0',
            'latitude1' => 'required|numeric|between:-90,90',
            'longitude1' => 'required|numeric|between:-180,180',
            'latitude2' => 'nullable|numeric|between:-90,90',
            'longitude2' => 'nullable|numeric|between:-180,180',
            'latitude3' => 'nullable|numeric|between:-90,90',
            'longitude3' => 'nullable|numeric|between:-180,180',
            'latitude4' => 'nullable|numeric|between:-90,90',
            'longitude4' => 'nullable|numeric|between:-180,180',
        ];
    }

    public function toDto(self $request): OrganizationsByGeoAreaRequestDto
    {
        /** @var string[] $validated */
        $validated = $request->validated();

        return OrganizationsByGeoAreaRequestDto::fromArray($validated);
    }
}
