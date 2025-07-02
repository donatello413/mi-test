<?php

declare(strict_types=1);

use App\Http\Actions\GetOrganizationsByBuildingAction;
use App\Http\Actions\GetOrganizationsByBusinessAction;
use App\Http\Actions\GetOrganizationsByBusinessTreeAction;
use App\Http\Actions\GetOrganizationsByGeoAreaAction;
use App\Http\Actions\GetOrganizationsByIdAction;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')
    ->middleware('apikey')
    ->group(function () {
        Route::prefix('organizations/')->group(callback: function () {
            Route::get('building', GetOrganizationsByBuildingAction::class);
            Route::get('business', GetOrganizationsByBusinessAction::class);
            Route::get('geo-area', GetOrganizationsByGeoAreaAction::class);
            Route::get('business-tree', GetOrganizationsByBusinessTreeAction::class);
        });
    })
    ->group(function () {
        Route::prefix('organization/')->group(callback: function () {
            Route::get('{id}', GetOrganizationsByIdAction::class);
        });
    })
;

