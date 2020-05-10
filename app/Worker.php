<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Worker extends Authenticatable
{
    use Notifiable;
    protected $table = 'workers';
    
    public $timestamps = false;

    protected $fillable = [
        'lastName',
        'firstName',
        'idNumber',
        'idPicture',
        'gender',
        'contactNumber',
        'address',
        'status',
        'password'
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function skill()
    {
        return $this->belongsTo('App\Skill');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function education()
    {
        return $this->belongsTo('App\Education');
    }

   public function contracts()
   {
       return $this->hasMany('App\Contract');
   }

   public function schedule()
   {
       return $this->hasMany('App\Schedule');
   }

   public function Attendance()
   {
       return $this->hasMany('App\Attendance');
   }
   public function overtime()
   {
       return $this->hasMany('App\OverTime');
   }
   public function salary()
   {
       return $this->hasMany('App\Salary');
   }
   public function deduction()
   {
       return $this->hasOne('App\SalaryDeduction');
   }
   public function logs()
   {
       return $this->hasMany('App\Logs');
   }
   public function address()
   {
       return $this->hasMany('App\Addresss');
   }
}
