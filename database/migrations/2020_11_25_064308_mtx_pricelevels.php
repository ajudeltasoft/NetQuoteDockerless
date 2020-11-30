<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MtxPricelevels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtx_pricelevels', function (Blueprint $table) {
            $table->id()->autoIncrement()->unsigned();
            $table->foreignId('catid')->references('id')->on('catalogues');
            $table->foreignId('speciesid')->references('id')->on('species');
            $table->foreignId('drstyleid')->references('id')->on('doorstyles');
            $table->foreignId('colorid')->references('id')->on('colors');
            $table->foreignId('prlevelid')->references('id')->on('pricelevels');
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
        Schema::dropIfExists('mtx_pricelevels');
    }
}
