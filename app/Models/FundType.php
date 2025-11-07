<?php

namespace App\Models;

use App\Traits\Model\SelectOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class FundType extends Model
{
    use HasTranslations;
    use SelectOptions;

    protected $fillable = [
        'name',
        'description',
        'active',
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

    public function funds(): HasMany|FundType
    {
        return $this->hasMany(Fund::class);
    }
}
