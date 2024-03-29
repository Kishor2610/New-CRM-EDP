<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation_sale extends Model
{
    public function Quotation(){
        return $this->belongsTo('App\Quotation');
    }

    public function product(){
        return $this->belongsTo('App\Product');
    }

}
