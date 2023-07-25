<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('prescription_cycle', function (Blueprint $table) {
            $table->bigInteger('reason_id')->unsigned()->nullable();
            $table->foreign('reason_id')->references('id')->on('rx_discontinue_reason')->onDelete('cascade');
            $table->string('rx_copy_link')->nullable();
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
