<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{

    public function quotation_sale(){
        return $this->hasMany('App\Sales');
    }

    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function quotation_sales()
    {
        return $this->hasMany(Quotation_sale::class);
    }


}
