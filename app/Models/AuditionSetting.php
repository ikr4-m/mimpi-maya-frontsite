<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $form_url
 * @property \Illuminate\Support\Carbon $audition_start
 * @property \Illuminate\Support\Carbon $audition_end
 * @property string|null $tagline
 * @property string|null $about_title
 * @property string|null $about_description
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionSetting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionSetting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionSetting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionSetting whereAboutDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionSetting whereAboutTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionSetting whereAuditionEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionSetting whereAuditionStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionSetting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionSetting whereFormUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionSetting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionSetting whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionSetting whereTagline($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AuditionSetting whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AuditionSetting extends Model
{
    protected $fillable = [
        'form_url',
        'audition_start',
        'audition_end',
        'tagline',
        'about_title',
        'about_description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'audition_start' => 'datetime',
            'audition_end' => 'datetime',
            'is_active' => 'boolean',
        ];
    }
}
