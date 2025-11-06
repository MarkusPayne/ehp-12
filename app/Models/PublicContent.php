<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


/**
 * @property string|null $content
 */
class PublicContent extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name', 'content',
    ];

    public array $translatable = ['content'];
}
