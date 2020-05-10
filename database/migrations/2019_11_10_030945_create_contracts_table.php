<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('worker_id');
            $table->date('startingDate');
            $table->date('expiryDate');
            $table->integer('duration');
        });
    }
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
