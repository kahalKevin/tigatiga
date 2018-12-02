<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ContactUsContent extends Model {
	
    public $timestamps = false;
    
    protected $table = 'cms_tm_fe_contact_us';

    protected $fillable = [
        '_content',
        'created_by',
        'created_at'
    ];
}