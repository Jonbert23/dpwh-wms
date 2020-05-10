<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryDeductionsTable extends Migration
{
    public function up()
    {
        Schema::create('salary_deductions', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('worker_id');
            $table->date('date');
            $table->integer('PAGIBIG');
            $table->integer('GSIS');
            $table->integer('PHILHEALTH');
            $table->integer('status');
        });
    }
    public function down()
    {
        Schema::dropIfExists('salary_deductions');
    }
}
