<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    protected $fillable = [
        'id','name'
    ];

    public function terms(){
        return $this->hasMany('App\Term', 'dictionary_id', 'id');
    }
}
