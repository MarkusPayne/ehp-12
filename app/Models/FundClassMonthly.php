<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FundClassMonthly extends Model
{
    protected $fillable = [
        'fund_class_id',
        'date',
        'nav',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    public function fundClass(): BelongsTo
    {
        return $this->belongsTo(FundClass::class);
    }

    public function fundClassMonthlyDetails(): HasMany
    {
        return $this->hasMany(FundClassMonthlyDetail::class);
    }
}
