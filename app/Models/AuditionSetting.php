<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
