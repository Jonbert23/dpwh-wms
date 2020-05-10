<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryDeduction extends Model
{
    public $timestamps = false;

    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }
}
