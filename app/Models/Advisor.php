<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Advisor extends Model
{
    use HasTranslations;

    protected $fillable = [
        'location_id',
        'name',
        'title',
        'phone',
        'email',
        'active',
    ];

    public array $translatable = ['title', 'name'];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }
}
