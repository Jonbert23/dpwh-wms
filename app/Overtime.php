<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    public $timestamps = false;
    public $fillable = [
        'Date',
        'signin',
        'signout',
    ];

    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }
}
