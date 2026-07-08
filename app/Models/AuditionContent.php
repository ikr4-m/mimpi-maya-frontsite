<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

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
