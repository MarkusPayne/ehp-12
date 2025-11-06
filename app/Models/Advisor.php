<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Advisor extends Model
{
    use HasTranslations;

    protected $fillable = [
        'location_id',
        'name',
        'title',
        'phone',
        'email',
        'active',
    ];

    public array $translatable = ['title', 'name'];

    protected function casts(): array
    {
        return [
            'active' => 'boolean',
        ];
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
