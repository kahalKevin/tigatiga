<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "fe_tx_order";
    public $incrementing = false;

    public function typeStatus()
    {
    	return $this->hasOne('App\Model\Type', 'id', 'status_id');
    }

    public function typePaymentMethod()
    {
    	return $this->hasOne('App\Model\Type', 'id', 'payment_gateway_id');
    }    
}
