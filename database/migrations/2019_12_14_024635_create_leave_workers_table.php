<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveWorkersTable extends Migration
{
   
    public function up()
    {
        Schema::create('leave_workers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('worker_id');
            $table->date('startDate');
            $table->date('endDate');
        });
    }
    public function down()
    {
        Schema::dropIfExists('leave_workers');
    }
}
