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
        Schema::create('prescription_cycle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rx_id')->unsigned();
            $table->foreign('rx_id')->references('id')->on('rx_entry')->onDelete('cascade');
            $table->bigInteger('prescription_id')->unsigned();
            $table->foreign('prescription_id')->references('id')->on('prescriptions')->onDelete('cascade');
            $table->bigInteger('cycle_number')->nullable();
            $table->enum('cycle_repeated', ['yes','no'])->nullable();
            $table->string('reason')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('prescription_cycle');
    }
};
