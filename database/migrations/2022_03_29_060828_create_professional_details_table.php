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
        Schema::dropIfExists('professional_details');
        Schema::create('professional_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->bigInteger('regional_manager_id')->unsigned()->nullable();
            $table->foreign('regional_manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('area_manager_id')->unsigned()->nullable();
            $table->foreign('area_manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('region_id')->unsigned()->nullable();
            $table->foreign('region_id')->references('id')->on('region')->onDelete('cascade');
            $table->bigInteger('area_id')->unsigned()->nullable();
            $table->foreign('area_id')->references('id')->on('area')->onDelete('cascade');
            $table->bigInteger('team_id')->unsigned()->nullable();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->string('profile_img')->nullable();
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
        Schema::dropIfExists('professional_details');
    }
};
