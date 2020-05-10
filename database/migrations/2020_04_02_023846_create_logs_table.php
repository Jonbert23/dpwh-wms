<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
   
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('worker_id');
            $table->string('activity');
            $table->date('date');
            $table->time('time');
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
