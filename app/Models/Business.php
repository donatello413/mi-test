<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\BusinessFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Business extends Model
{
    /** @use HasFactory<BusinessFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'parent_id'
    ];

    /**
     * @return HasMany<Business>
     */
    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * @return BelongsTo<Business>
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * Получает древовидный список предков текущей модели.
     *
     * @return array<Model> Список моделей предков в виде массива.
     */
    public function getAncestorsTree(): array
    {
        $ancestors = [];
        $current = $this->parent;

        while ($current) {
            $ancestors[] = $current;
            $current = $current->parent;
        }

        return $ancestors;
    }
}
