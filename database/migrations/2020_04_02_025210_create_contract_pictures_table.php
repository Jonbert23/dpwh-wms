<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractPicturesTable extends Migration
{
    public function up()
    {
        Schema::create('contract_pictures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('contract_id');
            $table->string('photo');
        });
    }

    public function down()
    {
        Schema::dropIfExists('contract_pictures');
    }
}
