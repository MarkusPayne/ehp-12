<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NewsType extends Model
{
    protected $fillable = [
        'news_type_name',
    ];

    public function news(): NewsType|HasMany
    {
        return $this->hasMany(News::class);
    }
}
