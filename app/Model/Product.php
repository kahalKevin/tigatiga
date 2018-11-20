<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['delete_at'];
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

    public function carts()
    {
        return $this->belongsToMany('App\Model\Cart', 'product_id', 'id');
    }
}
