<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOvertimesTable extends Migration
{
    public function up()
    {
        Schema::create('overtimes', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('worker_id');
            $table->date('date');
            $table->time('signin');
            $table->time('signout');
        });
    }
    public function down()
    {
        Schema::dropIfExists('overtimes');
    }
}
