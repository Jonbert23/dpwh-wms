<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = ['dateFrom','dateTo','work_id','location_id'];
    public $timestamps = false;

    public function worker()
    {
       return $this->belongsTo('App\Worker'); 
    }

    public function work()
    {
        return $this->belongsTo('App\Work');
    }

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

}
