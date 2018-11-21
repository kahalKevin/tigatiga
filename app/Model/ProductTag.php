<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;

class ProductTag extends Model
{
    protected $table = "cms_tm_product_tag";

    protected static function boot()
    {
        parent::boot();

        //static::addGlobalScope(new ActiveScope);
    }
}
