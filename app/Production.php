<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $table = 'productions';

    protected $fillable = 
    [
        'company_name', 'order_id', 'item_code', 'item_name','process'
    ];
    public function design()
    {
        return $this->belongsTo(Design::class, 'order_id', 'order_id');
    }
}
