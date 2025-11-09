<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
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

    #[Scope]
    protected function active(Builder $query): void
    {
        $query->where('active', 1);
    }

    protected function casts(): array
    {
        return [
            'inception_date' => 'date',
            'registered_eligible' => 'boolean',
            'active' => 'boolean',
        ];
    }

    protected function lastNav(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->fundClassNavs()->latest()->first(),
        );
    }

    public function fund(): BelongsTo
    {
        return $this->belongsTo(Fund::class);
    }

    public function fundClassNavs(): HasMany
    {
        return $this->hasMany(FundClassNav::class);
    }

    public function fundClassMonthly(): HasMany
    {
        return $this->hasMany(FundClassMonthly::class);
    }
}
