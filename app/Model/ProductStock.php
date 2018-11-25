<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductStock extends Model
{
    use SoftDeletes;
    
    protected $table = "cms_tm_product_stock";

    public function size()
    {
        return $this->hasOne('App\Model\Size', 'id', 'size_id');
    }
}
