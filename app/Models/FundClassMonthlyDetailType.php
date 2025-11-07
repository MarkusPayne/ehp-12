<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class FundClassMonthlyDetailType extends Model
{
    use HasTranslations;

    protected $fillable = [
        'code',
        'name',
        'top',
        'label',
    ];

    public array $translatable = ['code', 'name'];

    public function fundClassMonthlyDetails(): HasMany
    {
        return $this->hasMany(FundClassMonthlyDetail::class);
    }
}
