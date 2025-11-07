<?php

namespace App\Models;

use App\Traits\Model\SelectOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Translatable\HasTranslations;

class Fund extends Model
{
    use HasTranslations;
    use SelectOptions;

    public static bool $activeStatus = false;

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

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::setActiveStatus(true);
    }

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
            'inception_date' => 'date',
        ];
    }

    public function documents(): Fund|HasMany
    {
        return $this->hasMany(FundDocument::class);
    }

    public function fundType(): Fund|BelongsTo
    {
        return $this->belongsTo(FundType::class);
    }
}
