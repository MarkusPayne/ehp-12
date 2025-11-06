<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static ?string getContent(string $name)
 *
 * @see \App\Services\PublicContentService
 *
 * @mixin \App\Services\PublicContentService
 */
class PublicContentService extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \App\Services\PublicContentService::class;
    }
}
