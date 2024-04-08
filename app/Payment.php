<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    
    protected $table = 'payments';
    
    protected $fillable = ['customer_id', 'total_bills','total_received','remaining_balance','payments_status'];


}
