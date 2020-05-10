<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
  
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('worker_id');
            $table->integer('salaryAmount');
            $table->date('date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('salaries');
    }
}
