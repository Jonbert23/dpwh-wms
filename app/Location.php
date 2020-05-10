<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['zoneName','baranagayName','cityName'];
    public $timestamps = false;
}
