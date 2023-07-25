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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rx_id')->unsigned();
            $table->foreign('rx_id')->references('id')->on('rx_entry')->onDelete('cascade');
            $table->bigInteger('indication_id')->unsigned();
            $table->foreign('indication_id')->references('id')->on('indications')->onDelete('cascade');
            $table->string('schedule')->nullable();
            $table->string('dose')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('rx_copy_link')->nullable();
            $table->string('ir_name')->nullable();
            $table->string('nm_name')->nullable();
            $table->bigInteger('tumour_type_id')->unsigned()->nullable();
            $table->enum('pvt_involvement', ['yes','no']);
            $table->bigInteger('bclc_stage_id')->unsigned()->nullable();
            $table->bigInteger('pugh_score_id')->unsigned()->nullable();
            $table->string('liver_tumour_volume')->nullable();
            $table->string('lung_shunt')->nullable();
            $table->bigInteger('dmode_id')->unsigned()->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    // $table->bigInteger('indication_category_id')->unsigned();
    // $table->foreign('indication_category_id')->references('id')->on('indication_category')->onDelete('cascade');
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prescriptions');
    }
};
