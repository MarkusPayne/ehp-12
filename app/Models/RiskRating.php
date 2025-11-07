<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class RiskRating extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'description',
        'active',
        'sort_order',
    ];

    public array $translatable = ['name', 'description'];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function funds(): HasMany
    {
        return $this->hasMany(Fund::class);
    }
}
