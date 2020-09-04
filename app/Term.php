<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = [
        'id','name','dictionary_id'
    ];

    public function translations(){
        return $this->hasMany('App\Translation', 'term_id', 'id');
    }
}
