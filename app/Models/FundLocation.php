<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class FundLocation extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
    ];

    public array $translatable = ['name'];

    public function funds(): HasMany
    {
        return $this->hasMany(Fund::class);
    }
}
