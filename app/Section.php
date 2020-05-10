<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $timestamp = false;

    protected $fillable = ['name'];
}
