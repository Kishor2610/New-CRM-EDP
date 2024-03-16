<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class RawMaterial extends Model
{
    protected $table = 'raw_material';
    
    protected $fillable = ['material_name', 'status'];


    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class);
    }

    public function Supplier(){
        
        return $this->hasMany('App\Supplier');
    }
    
    
}




?>