<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('worker_id');
            $table->date('Date');
            $table->time('morningSignin');
            $table->time('morningSignout');
            $table->time('afternoonSignin');
            $table->time('afternoonSignout');
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
