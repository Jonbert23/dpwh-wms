<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveCreditsTable extends Migration
{
    public function up()
    {
        Schema::create('leave_credits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('worker_id');
            $table->integer('totalLeave');
            $table->integer('remainingLeave');
            $table->date('startDate');
            $table->date('endDate');
        });
    }
    public function down()
    {
        Schema::dropIfExists('leave_credits');
    }
}
