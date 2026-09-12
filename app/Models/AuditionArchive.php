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
 * @property-read string $link_url
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionArchive newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionArchive newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionArchive query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionArchive whereAuditionEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionArchive whereAuditionStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionArchive whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionArchive whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionArchive whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionArchive whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionArchive whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionArchive whereUpdatedAt($value)
 * @property array<array-key, mixed>|null $thumbnails
 * @property-read string|null $random_thumbnail_url
 * @property-read string|null $thumbnail_url
 * @property-read string[] $thumbnail_urls
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionArchive whereThumbnails($value)
 * @mixin \Eloquent
 */
class AuditionArchive extends Model
{
    protected $fillable = [
        'name',
        'description',
        'slug',
        'audition_start',
        'audition_end',
        'thumbnails',
    ];

    protected function casts(): array
    {
        return [
            'audition_start' => 'datetime',
            'audition_end' => 'datetime',
            'thumbnails' => 'array',
        ];
    }

    /**
     * @return string[]
     */
    public function getThumbnailUrlsAttribute(): array
    {
        if (empty($this->thumbnails)) {
            return [];
        }

        return array_map(function (string $path) {
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                return $path;
            }

            if (str_starts_with($path, 'images/')) {
                return asset($path);
            }

            return \Illuminate\Support\Facades\Storage::disk('public')->url($path);
        }, $this->thumbnails);
    }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail_urls[0] ?? null;
    }

    public function getRandomThumbnailUrlAttribute(): ?string
    {
        $urls = $this->thumbnail_urls;

        return ! empty($urls) ? $urls[array_rand($urls)] : null;
    }

    public function getLinkUrlAttribute(): string
    {
        return str_starts_with($this->slug, 'http://') || str_starts_with($this->slug, 'https://')
            ? $this->slug
            : route('index.audition.show', $this->slug);
    }
}
