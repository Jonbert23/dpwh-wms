<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['worker_id','zone','barangay','city'];
    public $timestamps = false;
}
