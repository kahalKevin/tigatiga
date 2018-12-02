<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model {
	
    public $timestamps = false;
    
    protected $table = 'fe_tx_contact_us';

    protected $fillable = [
        '_name',
        '_email',
        '_message',
        'created_at'
    ];
}