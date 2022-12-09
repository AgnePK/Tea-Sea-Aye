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
        Schema::create('store_tea', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('store_id');
            $table->UnsignedBigInteger('tea_id');

            $table->foreign('store_id')->references('id')->on('stores')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tea_id')->references('id')->on('teas')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('store_tea');
    }
};
