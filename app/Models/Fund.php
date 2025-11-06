<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Fund extends Model
{
    use HasTranslations;
    protected $fillable = [
        'fund_type_id',
        'fund_location_id',
        'name',
        'description',
        'overview',
        'bullet',
        'risk_level_id',
        'target_return_start',
        'target_return_end',
        'active',
        'portfolio',
        'inception_date',
        'distributions',
        'tax_plan_status',
        'performance_fee',
        'minimum_investment',
        'minimum_subsequent',
        'liquidity',
        'redemptions',
        'valuations',
        'pdf_blurb',
        'risk_rating_id',
        'pdf_disclaimer',
        'web_disclaimer',
        'nav_frequency',
    ];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
            'inception_date' => 'date',
        ];
    }

    public array $translatable = [
        'name',
        'description',
        'overview',
        'portfolio',
        'distributions',
        'tax_plan_status',
        'performance_fee',
        'liquidity',
        'redemptions',
        'valuations',
        'pdf_blurb',
        'web_disclaimer',
        'pdf_disclaimer',
    ];

    public function documents(): Fund|HasMany
    {
        return $this->hasMany(FundDocument::class);
    }
}
