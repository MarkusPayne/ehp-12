<?php

namespace App\Models;

use App\Traits\Model\SelectOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class RiskLevel extends Model
{
    use HasTranslations;
    use SelectOptions;

    protected $fillable = [
        'name',
        'description',
        'active',
        'sort_order',
    ];

    public array $translatable = ['name', 'description'];

    protected static function booted(): void
    {
        static::setActiveStatus(true);
    }

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
