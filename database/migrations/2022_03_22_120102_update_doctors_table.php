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
         Schema::table('doctors', function (Blueprint $table) {
            $table->string('city_id');
            $table->string('institute');
            $table->enum('speciality', ['Medical Oncologist', 'Radiation Oncologist','Surgical Oncologist','Hematologist','Uro-Oncologist','Gastroenetrologist','Hepatologist','Transp Surgeon']);
            $table->enum('institute_type', ['trade','Government','corporate']);
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
