<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $timestamp = false;

    protected $fillable = ['name'];
}
