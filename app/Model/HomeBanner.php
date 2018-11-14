<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\ActiveScope;

class HomeBanner extends Model
{
    protected $table = 'cms_tm_fe_homebanner';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope);
    }
}