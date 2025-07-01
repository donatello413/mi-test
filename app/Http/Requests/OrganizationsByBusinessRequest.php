<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Transfers\OrganizationsByBusinessRequestDto;
use Illuminate\Foundation\Http\FormRequest;

class OrganizationsByBusinessRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'slug' => 'string',
        ];
    }

    public function toDto(self $request): OrganizationsByBusinessRequestDto
    {
        /** @var string[] $validated */
        $validated = $request->validated();

        return OrganizationsByBusinessRequestDto::fromArray($validated);
    }
}
