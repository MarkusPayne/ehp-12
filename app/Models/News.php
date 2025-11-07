<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class News extends Model
{
    use HasTranslations;

    protected $fillable = [
        'news_type_id',
        'news_date',
        'title',
        'sub_title',
        'blurb',
        'link',
        'active',
    ];

    public array $translatable = ['title', 'sub_title', 'blurb'];

    protected function casts(): array
    {
        return [
            'news_date' => 'date',
            'active' => 'boolean',
        ];
    }

    public function newsType(): BelongsTo
    {
        return $this->belongsTo(NewsType::class);
    }
}
