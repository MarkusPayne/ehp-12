<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'registered_eligble',
        'active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'inception_date' => 'date',
            'registered_eligble' => 'boolean',
            'active' => 'boolean',
        ];
    }

    public $translatable = ['fund_class_name', 'currency'];

    public function fund(): BelongsTo
    {
        return $this->belongsTo(Fund::class);
    }
}
