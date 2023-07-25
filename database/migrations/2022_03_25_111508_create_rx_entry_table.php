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
        Schema::create('rx_entry', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('ff_id')->unsigned();
            $table->foreign('ff_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('brand_id')->unsigned();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->bigInteger('doctor_id')->unsigned();
            $table->foreign('doctor_id')->references('id')->on('doctors')->onDelete('cascade');
            $table->string('patient_name');
            $table->string('phone');
            $table->enum('contact_type',['caretaker','patient']);
            $table->bigInteger('parent_type_id')->unsigned();
            $table->foreign('parent_type_id')->references('id')->on('parent_type')->onDelete('cascade');
            $table->enum('status',['0','1']);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rx_entry');
    }
};
