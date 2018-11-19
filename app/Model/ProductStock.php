<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;

class ProductStock extends Model
{
    protected $table = "cms_tm_product_stock";

    protected static function boot()
    {
        parent::boot();

//        static::addGlobalScope(new ActiveScope);
    }

    public function size()
    {
        return $this->hasOne('App\Model\Size', 'id', 'size_id');
    }
}
