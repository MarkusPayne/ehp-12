<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FundClassMonthlyDetail extends Model
{
    protected $fillable = [
        'fund_class_monthly_id',
        'fund_class_monthly_detail_type_id',
        'heading',
        'key',
        'value',
    ];

    public function fundClassMonthly(): BelongsTo
    {
        return $this->belongsTo(FundClassMonthly::class);
    }

    public function fundClassMonthlyDetailType(): BelongsTo
    {
        return $this->belongsTo(FundClassMonthlyDetailType::class);
    }
}
