<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;

class ProductGallery extends Model
{
    protected $table = "cms_tm_product_attachment";

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope);
    }

    public function product()
    {
        return $this->belongsTo('App\Model\Product', 'product_id');
    }
}
