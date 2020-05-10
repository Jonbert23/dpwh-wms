<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    public $timestamps = false;

    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }
}
