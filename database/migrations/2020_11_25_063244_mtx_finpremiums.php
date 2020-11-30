<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MtxFinpremiums extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtx_finpremiums', function (Blueprint $table) {
            $table->id()->autoIncrement()->unsigned();
            $table->foreignId('catid')->references('id')->on('catalogues');
            $table->foreignId('speciesid')->references('id')->on('species');
            $table->foreignId('colorid')->references('id')->on('colors');
            $table->foreignId('premiumid')->references('id')->on('premiums');
            $table->float('premium_percentage', 8, 5)->nullable($value = true);
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mtx_finpremiums');
    }
}
