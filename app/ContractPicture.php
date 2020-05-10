<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractPicture extends Model
{
    protected $fillable = ['contract_id','photo'];
    public $timestamps = false;
}
