<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) 
        {
            $table->bigIncrements('id');
            $table->integer('role_id')->index()->unsigned();
            $table->integer('skill_id')->index()->unsigned();
            $table->integer('education_id')->index()->unsigned();
            $table->integer('section_id')->index()->unsigned();
            $table->string('lastName');
            $table->string('firstName');
            $table->integer('idNumber');
            $table->string('idPicture');
            $table->string('gender');
            $table->bigInteger('contactNumber');
            $table->integer('status')->default(1);
            $table->string('password');     
        });
    }

    public function down()
    {
        Schema::dropIfExists('workers');
    }
}
