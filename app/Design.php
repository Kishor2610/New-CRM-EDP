<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    protected $table = 'design';

    protected $fillable = 
    [
        'company_name', 'po_number', 'order_id', 'item_code', 'qty', 'process', 'image', 'remark'
    ];
}
