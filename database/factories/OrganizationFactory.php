<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Random\RandomException;

/**
 * @extends Factory<Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws RandomException
     */
    public function definition(): array
    {
        $name = fake()->company();
        $slug = Str::slug($name);

        return [
            'name' => $name,
            'slug' => $slug,
            'phones' => fake()->randomElements(
                array: [
                    fake()->phoneNumber(),
                    fake()->phoneNumber(),
                    fake()->phoneNumber()
                ],
                count: random_int(1, 3)
            ),
        ];
    }
}
