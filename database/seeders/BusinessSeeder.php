<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BusinessSeeder extends Seeder
{
    public function run(): void
    {
        $this->createBusinesses($this->creteRealData());
    }

    private function createBusinesses(array $tree, ?int $parentId = null): void
    {
        foreach ($tree as $item) {
            $business = Business::create([
                'name' => $item['title'],
                'slug' => $item['slug'],
                'parent_id' => $parentId,
            ]);

            if (isset($item['children'])) {
                $this->createBusinesses($item['children'], $business->id);
            }
        }
    }

    private function creteRealData(): array
    {
        return [
            [
                'title' => 'Еда',
                'slug' => Str::slug('Еда'),
                'children' => [
                    [
                        'title' => 'Мясная продукция',
                        'slug' => Str::slug('Мясная продукция'),
                        'children' => [
                            ['title' => 'Колбасы', 'slug' => Str::slug('Колбасы')],
                            ['title' => 'Полуфабрикаты', 'slug' => Str::slug('Полуфабрикаты')],
                        ]
                    ],
                    [
                        'title' => 'Молочная продукция',
                        'slug' => Str::slug('Молочная продукция'),
                        'children' => [
                            ['title' => 'Молоко', 'slug' => Str::slug('Молоко')],
                            ['title' => 'Сыры', 'slug' => Str::slug('Сыры')],
                        ]
                    ],
                    [
                        'title' => 'Хлебобулочные изделия',
                        'slug' => Str::slug('Хлебобулочные изделия'),
                        'children' => [
                            ['title' => 'Хлеб', 'slug' => Str::slug('Хлеб')],
                            ['title' => 'Выпечка', 'slug' => Str::slug('Выпечка')],
                        ]
                    ],
                ],
            ],
            [
                'title' => 'Автомобили',
                'slug' => Str::slug('Автомобили'),
                'children' => [
                    [
                        'title' => 'Грузовые',
                        'slug' => Str::slug('Грузовые'),
                        'children' => [
                            ['title' => 'Фуры', 'slug' => Str::slug('Фуры')],
                            ['title' => 'Самосвалы', 'slug' => Str::slug('Самосвалы')],
                        ]
                    ],
                    [
                        'title' => 'Легковые',
                        'slug' => Str::slug('Легковые'),
                        'children' => [
                            ['title' => 'Запчасти', 'slug' => Str::slug('Запчасти')],
                            ['title' => 'Аксессуары', 'slug' => Str::slug('Аксессуары')],
                        ],
                    ],
                    [
                        'title' => 'Спецтехника',
                        'slug' => Str::slug('Спецтехника'),
                        'children' => [
                            ['title' => 'Экскаваторы', 'slug' => Str::slug('Экскаваторы')],
                            ['title' => 'Краны', 'slug' => Str::slug('Краны')],
                        ]
                    ]
                ],
            ],
            [
                'title' => 'Одежда',
                'slug' => Str::slug('Одежда'),
                'children' => [
                    [
                        'title' => 'Мужская',
                        'slug' => Str::slug('Мужская'),
                        'children' => [
                            ['title' => 'Верхняя одежда', 'slug' => Str::slug('Верхняя одежда')],
                            ['title' => 'Нижняя одежда', 'slug' => Str::slug('Нижняя одежда')],
                        ]
                    ],
                    [
                        'title' => 'Женская',
                        'slug' => Str::slug('Женская'),
                        'children' => [
                            ['title' => 'Платья', 'slug' => Str::slug('Платья')],
                            ['title' => 'Обувь', 'slug' => Str::slug('Обувь')],
                        ]
                    ],
                    [
                        'title' => 'Детская',
                        'slug' => Str::slug('Детская'),
                        'children' => [
                            ['title' => 'Для мальчиков', 'slug' => Str::slug('Для мальчиков')],
                            ['title' => 'Для девочек', 'slug' => Str::slug('Для девочек')],
                        ]
                    ]
                ]
            ]
        ];
    }

    private function creteFakeData(): void
    {
        $businesses = Business::factory()->count(50)->create();

        $businesses->each(function (Business $business) use ($businesses) {
            if (fake()->boolean(chanceOfGettingTrue: 70)) {
                /** @var Business $parent */
                $parent = $businesses->where('id', '!=', $business->id)->random();

                $business->update(['parent_id' => $parent->id]);
            }
        });
    }
}
