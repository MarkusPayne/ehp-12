<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FundClassNav extends Model
{
    protected $fillable = [
        'fund_class_id',
        'nav_date',
        'nav',
        'daily_distribution',
        'daily_dividend',
        'percent_change',
        'penny_change',
        'active',
    ];

    public function fundClass(): BelongsTo
    {
        return $this->belongsTo(FundClass::class);
    }

    protected function casts(): array
    {
        return [
            'nav_date' => 'date',
        ];
    }
}
