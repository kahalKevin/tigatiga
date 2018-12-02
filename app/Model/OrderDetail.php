<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = "fe_tx_order_detail";

    public function products()
    {
    	return $this->hasOne('App\Model\Product', 'id', 'product_id');
    }

    public function productStocks()
    {
    	return $this->hasOne('App\Model\ProductStock', 'id', 'product_stock_id');
    }

    public function order()
    {
    	return $this->hasOne('App\Model\Order', 'id', 'order_id');
    }    
}
