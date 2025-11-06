<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FundDocument extends Model
{
    protected $fillable = [
        'fund_id',
        'document_type_id',
        'language',
        'document_name',
        'file_name',
        'edit',
    ];

    protected function casts(): array
    {
        return [
            'edit' => 'boolean',
        ];
    }

    public function fund(): BelongsTo
    {
        return $this->belongsTo(Fund::class);
    }

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }
}
