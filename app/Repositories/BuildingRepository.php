<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Interfaces\BuildingRepositoryInterface;
use App\Models\Building;
use App\Transfers\BuildingDto;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

class BuildingRepository implements BuildingRepositoryInterface
{
    public function getBuildingByAddress(string $address): BuildingDto
    {
        $building = Building::query()->where('address', $address)->first();

        if ($building === null) {
            throw new ModelNotFoundException("Building with address '{$address}' not found");
        }

        return BuildingDto::fromModel($building);
    }

    /**
     * Получить ID зданий в радиусе (метрах) от точки (latitude, longitude)
     *
     * @param float $latitude
     * @param float $longitude
     * @param float $radius
     * @return Collection<int, BuildingDto>
     */
    public function getBuildingIdsByRadius(float $latitude, float $longitude, float $radius): Collection
    {
        $haversine = $this->getHaversine();

        $buildings = Building::query()
            ->whereRaw(
                "$haversine <= ?",
                [
                    $latitude,
                    $longitude,
                    $latitude,
                    $radius
                ]
            )
            ->get();

        if ($buildings->isEmpty()) {
            throw new ModelNotFoundException("Buildings in radius not found");
        }

        return $buildings->map(fn(Building $building) => BuildingDto::fromModel($building));
    }

    /**
     * Получить ID зданий в прямоугольной области (bounding box)
     *
     * @param array<> $points
     * @return Collection<int, BuildingDto>
     */
    public function getBuildingIdsByBoundingBox(array $points): Collection
    {
        $polygon = $this->createPolygon($points);

        $buildings = Building::query()
            ->whereRaw(
                "ST_Contains(ST_GeomFromText(?), ST_SetSRID(ST_MakePoint(longitude, latitude), 4326))",
                [$polygon]
            )
            ->get();

        dd($buildings);
        if ($buildings->isEmpty()) {
            throw new ModelNotFoundException("Buildings in bounding box not found");
        }

        return $buildings->map(fn(Building $building) => BuildingDto::fromModel($building));
    }

    /**
     * @return string
     */
    private function getHaversine(): string
    {
        return "(6371000 * acos(cos(radians(?)) * cos(radians(latitude)) 
                        * cos(radians(longitude) - radians(?)) 
                        + sin(radians(?)) * sin(radians(latitude))))";
    }

    /**
     * @param array $points
     * @return non-empty-string
     */
    private function createPolygon(array $points): string
    {
        $sortPoints = $this->sortPointsForPolygon($points);

        $polygonPointsString = implode(
            separator: ',',
            array: array_map(
                callback: static function ($point) {
                    return "{$point['longitude']} {$point['latitude']}";
                },
                array: $sortPoints
            )
        );

        $polygonPointsString .= ',' . "{$sortPoints[0]['longitude']} {$sortPoints[0]['latitude']}";

        return "POLYGON(($polygonPointsString))";
    }

    /**
     * @param array $points
     * @return array<array<string|int, float|int|string>>
     */
    private function sortPointsForPolygon(array $points): array
    {
        $centerLat = array_sum(array_column(array: $points, column_key: 'latitude')) / count($points);
        $centerLng = array_sum(array_column(array: $points, column_key: 'longitude')) / count($points);

        usort(
            array: $points,
            callback: static function ($a, $b) use ($centerLat, $centerLng) {
                $angleA = atan2(y: $a['latitude'] - $centerLat, x: $a['longitude'] - $centerLng);
                $angleB = atan2(y: $b['latitude'] - $centerLat, x: $b['longitude'] - $centerLng);
                return $angleA <=> $angleB;
            }
        );

        return $points;
    }
}