<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property string|null $title
 * @property string|null $description
 * @property string|null $label
 * @property string|null $url
 * @property string|null $icon
 * @property \Illuminate\Support\Carbon|null $date
 * @property int $sort_order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static Builder<static>|AuditionContent active()
 * @method static Builder<static>|AuditionContent byType(string $type)
 * @method static Builder<static>|AuditionContent newModelQuery()
 * @method static Builder<static>|AuditionContent newQuery()
 * @method static Builder<static>|AuditionContent query()
 * @method static Builder<static>|AuditionContent whereCreatedAt($value)
 * @method static Builder<static>|AuditionContent whereDate($value)
 * @method static Builder<static>|AuditionContent whereDescription($value)
 * @method static Builder<static>|AuditionContent whereIcon($value)
 * @method static Builder<static>|AuditionContent whereId($value)
 * @method static Builder<static>|AuditionContent whereIsActive($value)
 * @method static Builder<static>|AuditionContent whereLabel($value)
 * @method static Builder<static>|AuditionContent whereSortOrder($value)
 * @method static Builder<static>|AuditionContent whereTitle($value)
 * @method static Builder<static>|AuditionContent whereType($value)
 * @method static Builder<static>|AuditionContent whereUpdatedAt($value)
 * @method static Builder<static>|AuditionContent whereUrl($value)
 * @mixin \Eloquent
 */
class AuditionContent extends Model
{
    protected $fillable = [
        'type',
        'title',
        'description',
        'label',
        'url',
        'icon',
        'date',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeByType(Builder $query, string $type): Builder
    {
        return $query->where('type', $type);
    }
}
