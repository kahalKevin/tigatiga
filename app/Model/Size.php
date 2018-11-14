<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;

class Size extends Model
{
    protected $table = "cms_tm_size";

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope);
    }
}
