<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $timestamps = false;
    public $fillable = [
        'Date',
        'morningSignin',
        'morningSignout',
        'morningTimeLate',
        'afternoonSignin',
        'afternoonSignout',
        'afternoonTimeLate',
    ];


    public function worker()
    {
        return $this->belongsTo('App\Worker');
    }
}
