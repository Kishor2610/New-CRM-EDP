<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $table = 'productions';

    protected $fillable = 
    [
        'company_name', 'order_id', 'item_code', 'process'
    ];
}
