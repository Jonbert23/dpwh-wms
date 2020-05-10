<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    public  $timestamps = false;
    protected $fillabale = [
        'startingDate', 
        'expiryDate', 
        'duration'];
   
    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }
}
