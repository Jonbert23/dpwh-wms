<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $timestamp = false;

    protected $fillable = ['name'];
}
