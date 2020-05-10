<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $timestamp = false;

    protected $fillable = ['name'];
}
