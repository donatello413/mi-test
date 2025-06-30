<?php

declare(strict_types=1);

namespace App\Providers;

use App\Interfaces\BuildingRepositoryInterface;
use App\Interfaces\BusinessRepositoryInterface;
use App\Interfaces\OrganizationReaderInterface;
use App\Interfaces\OrganizationRepositoryInterface;
use App\Reader\OrganizationReader;
use App\Repositories\BuildingRepository;
use App\Repositories\BusinessRepository;
use App\Repositories\OrganizationRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(OrganizationRepositoryInterface::class, OrganizationRepository::class);
        $this->app->singleton(BusinessRepositoryInterface::class, BusinessRepository::class);
        $this->app->singleton(BuildingRepositoryInterface::class, BuildingRepository::class);

        $this->app->singleton(OrganizationReaderInterface::class, function ($app) {
            return new OrganizationReader(
                $app->make(OrganizationRepositoryInterface::class),
                $app->make(BusinessRepositoryInterface::class),
                $app->make(BuildingRepositoryInterface::class)
            );
        });
    }

    public function boot(): void
    {
        //
    }
}
