<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSubscribe extends Model
{

    use SoftDeletes;
    protected $table = "fe_tm_user_subscribe";

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ActiveScope);
    }
}
