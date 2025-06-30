<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\BusinessRepositoryInterface;
use App\Models\Business;
use App\Transfers\BusinessDto;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BusinessRepository implements BusinessRepositoryInterface
{

    public function getBusinessBySlug(string $slug): BusinessDto
    {
        $business = Business::query()->with(['children'])->where('slug', $slug)->first();

        if ($business === null) {
            throw new ModelNotFoundException("Business with slug '{$slug}' not found");
        }

        return BusinessDto::fromModel($business);
    }
}