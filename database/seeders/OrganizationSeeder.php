<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Building;
use App\Models\Business;
use App\Models\Organization;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buildingIds = Building::query()->pluck('id')->toArray();
        $businessIds = Business::query()->pluck('id')->toArray();

        Organization::factory()
            ->count(count: 20)
            ->make()
            ->each(function (Organization $organization) use ($buildingIds, $businessIds) {
                $organization->building_id = fake()->randomElement($buildingIds);
                $organization->save();

                $organization->businesses()->attach(
                    fake()->randomElements($businessIds, random_int(1, 3))
                );
            });
    }
}
