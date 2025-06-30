<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Transfers\OrganizationsByBuildingRequestDto;
use Illuminate\Foundation\Http\FormRequest;

class OrganizationsByBuildingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'address' => 'string',
        ];
    }

    public function toDto(self $request): OrganizationsByBuildingRequestDto
    {
        /** @var string[] $validated */
        $validated = $request->validated();

        return new OrganizationsByBuildingRequestDto(
            $validated['address'],
        );
    }
}
