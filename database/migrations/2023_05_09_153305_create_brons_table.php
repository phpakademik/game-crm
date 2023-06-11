<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brons', function (Blueprint $table) {
            $table->id();
            $table->integer('filial_id');
            $table->integer('service_id');
            $table->date('date');
            $table->time('from');
            $table->time('to');
            $table->string('type');
            $table->integer('total_price'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brons');
    }
};
