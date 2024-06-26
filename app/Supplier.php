<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function product(){
        return $this->hasMany('App\Product');
    }
    
    public function rawMaterials(){
        return $this->belongsToMany(RawMaterial::class);
    }
    

}
