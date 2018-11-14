<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;

class Product extends Model
{
    protected $table = 'cms_tm_product';

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope);
    }

    public function productGalleries()
    {
        return $this->hasMany('App\Model\ProductGallery', 'product_id', 'id');
    }

    public function productStocks()
    {
        return $this->hasMany('App\Model\ProductStock', 'product_id', 'id');
    }
}
