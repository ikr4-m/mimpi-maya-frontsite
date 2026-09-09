<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string $slug
 * @property Carbon $audition_start
 * @property Carbon $audition_end
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class AuditionArchive extends Model
{
    protected $fillable = [
        'name',
        'description',
        'slug',
        'audition_start',
        'audition_end',
    ];

    protected function casts(): array
    {
        return [
            'audition_start' => 'datetime',
            'audition_end' => 'datetime',
        ];
    }

    public function getLinkUrlAttribute(): string
    {
        return str_starts_with($this->slug, 'http://') || str_starts_with($this->slug, 'https://')
            ? $this->slug
            : route('index.audition.show', $this->slug);
    }
}
