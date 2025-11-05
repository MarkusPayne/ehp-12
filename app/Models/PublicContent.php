<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PublicContent extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name', 'content',
    ];

    public array $translatable = ['content'];
}
