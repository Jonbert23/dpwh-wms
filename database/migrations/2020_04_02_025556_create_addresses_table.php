<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('worker_id');
            $table->string('zone');
            $table->string('barangay');
            $table->string('city');
            $table->integer('zipCode');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
