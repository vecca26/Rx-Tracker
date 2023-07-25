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
        Schema::table('rx_entry', function (Blueprint $table) {
            $table->bigInteger('speciality_id')->unsigned();
            $table->foreign('speciality_id')->references('id')->on('medical_speciality')->onDelete('cascade');
            $table->bigInteger('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('city')->onDelete('cascade');
            $table->bigInteger('institute_id')->unsigned();
            $table->foreign('institute_id')->references('id')->on('institute')->onDelete('cascade');
          });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
