<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class DocumentType extends Model
{
    use HasTranslations;
    protected $fillable = [
        'fund_type_id',
        'document_type_name',
        'description',
        'active',
        'hide',
    ];
    public array $translatable = ['document_type_name', 'description'];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
            'hide' => 'boolean',
        ];
    }
}
