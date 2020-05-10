<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $fillable = ['worker_id','activity_id','date','time'];
    public $timestamps = false;
}
