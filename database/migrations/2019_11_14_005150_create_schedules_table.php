<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('worker_id')->index()->unsigned();
            $table->integer('location_id')->index()->unsigned();
            $table->integer('work_id')->index()->unsigned();
            $table->integer('mpp');
            $table->date('dateFrom');
            $table->date('dateTo');
           
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
