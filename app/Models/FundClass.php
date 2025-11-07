<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FundClass extends Model
{
    protected $fillable = [
        'fund_id',
        'fund_data_code',
        'fund_code',
        'fund_class_name',
        'inception_date',
        'currency',
        'management_fee',
        'performance_fee',
        'trailer',
        'minimum_initial',
        'minimum_additional',
        'registered_eligible',
        'active',
        'sort_order',
    ];

    public array $translatable = ['fund_class_name', 'currency'];

    protected function casts(): array
    {
        return [
            'inception_date' => 'date',
            'registered_eligible' => 'boolean',
            'active' => 'boolean',
        ];
    }

    public function fund(): BelongsTo
    {
        return $this->belongsTo(Fund::class);
    }

    public function fundClassNavs(): HasMany
    {
        return $this->hasMany(FundClassNav::class);
    }

    public function fundClassMonthlys(): HasMany
    {
        return $this->hasMany(FundClassMonthly::class);
    }
}
