<?php

declare(strict_types=1);

namespace App\Transfers;

use Spatie\LaravelData\Data;

final class OrganizationsByGeoAreaRequestDto extends Data
{
    public function __construct(
        public ?float $radius = null,
        public float $latitude1,
        public float $longitude1,
        public ?float $latitude2 = null,
        public ?float $longitude2 = null,
        public ?float $latitude3 = null,
        public ?float $longitude3 = null,
        public ?float $latitude4 = null,
        public ?float $longitude4 = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        $validatedData = self::validate($data);

        return new self(
            radius: isset($validatedData['radius']) ? (float)$validatedData['radius'] : null,
            latitude1: (float)$validatedData['latitude1'],
            longitude1: (float)$validatedData['longitude1'],
            latitude2: isset($validatedData['latitude2']) ? (float)$validatedData['latitude2'] : null,
            longitude2: isset($validatedData['longitude2']) ? (float)$validatedData['longitude2'] : null,
            latitude3: isset($validatedData['latitude3']) ? (float)$validatedData['latitude3'] : null,
            longitude3: isset($validatedData['longitude3']) ? (float)$validatedData['longitude3'] : null,
            latitude4: isset($validatedData['latitude4']) ? (float)$validatedData['latitude4'] : null,
            longitude4: isset($validatedData['longitude4']) ? (float)$validatedData['longitude4'] : null,
        );
    }

    /**
     * @return array<array{latitude: float, longitude: float}>
     */
    public function getPoints(): array
    {
        $points = [
            ['latitude' => $this->latitude1, 'longitude' => $this->longitude1],
        ];

        if ($this->latitude2 !== null && $this->longitude2 !== null) {
            $points[] = ['latitude' => $this->latitude2, 'longitude' => $this->longitude2];
        }

        if ($this->latitude3 !== null && $this->longitude3 !== null) {
            $points[] = ['latitude' => $this->latitude3, 'longitude' => $this->longitude3];
        }

        if ($this->latitude4 !== null && $this->longitude4 !== null) {
            $points[] = ['latitude' => $this->latitude4, 'longitude' => $this->longitude4];
        }

        return $points;
    }
}
