<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
	use SoftDeletes;

	protected $dates = ['delete_at'];
    protected $table = "fe_tx_cart";

    public function products()
    {
    	return $this->hasOne('App\Model\Product', 'id', 'product_id');
    }

    public function productStocks()
    {
    	return $this->hasOne('App\Model\ProductStock', 'id', 'product_stock_id');
    }
}
