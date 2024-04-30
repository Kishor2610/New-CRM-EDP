<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $table = 'enquiries';
    
    protected $fillable = [
        'company_name',
        'mobile',
        'email',
        'item',
        'qty',
        'enquiry_source',
        'description',
        'customer_specification',
        'comment',
        'status',
    ];
    
}
