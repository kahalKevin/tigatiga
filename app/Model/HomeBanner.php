<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class HomeBanner extends Model
{
    protected $table = 'cms_tm_fe_homebanner';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('_active', function (Builder $builder) {
            $builder->where('_active', '=', '1');
        });
    }
}