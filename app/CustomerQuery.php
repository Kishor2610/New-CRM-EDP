<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerQuery extends Model
{
    
    protected $table = 'query';
    
    protected $fillable = ['query_subject','query_message'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
