<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;

class InventoryAds extends Model
{
    protected $table = "cms_tm_fe_inventory_ads";

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope);
    }
}
