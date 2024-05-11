<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    
    protected $fillable = [
        'company_name',
        'mobile',
        'email',
        'item',
        'po_number',
        'comment',
    ];
   
}
