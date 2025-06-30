<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\BuildingFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    /** @use HasFactory<BuildingFactory> */
    use HasFactory;

    protected $fillable = [
        'address',
        'latitude',
        'longitude'
    ];

    protected $casts = [
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

}
