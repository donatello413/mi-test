<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\OrganizationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Organization extends Model
{
    /** @use HasFactory<OrganizationFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'phones',
        'building_id'
    ];

    protected $casts = [
        'phones' => 'array',
    ];

    /**
     * @return BelongsTo<Building>
     */
    public function building(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'building_id');
    }

    /**'
     * @return BelongsToMany<Business>
     */
    public function businesses(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Business::class,
            table: 'business_organization',
            foreignPivotKey: 'organization_id',
            relatedPivotKey: 'business_id'
        );
    }
}
