<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Team extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'title',
        'bio',
        'headshot_path',
        'active',
    ];

    public array $translatable = ['title', 'bio'];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }
}
