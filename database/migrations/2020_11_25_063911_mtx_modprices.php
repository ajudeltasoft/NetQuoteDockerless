<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MtxModprices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mtx_modprices', function (Blueprint $table) {
            $table->id()->autoIncrement()->unsigned();
            $table->foreignId('catid')->references('id')->on('catalogues');
            $table->foreignId('modid')->references('id')->on('modifications');
            $table->foreignId('prlevelid')->references('id')->on('pricelevels');
            $table->float('price', 8, 5)->nullable($value = true);
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
        Schema::dropIfExists('mtx_modprices');
    }
}
