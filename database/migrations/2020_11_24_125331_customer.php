<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Customer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id()->autoIncrement()->unsigned();
            $table->char('idcust',12)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->foreignId('catid')->references('id')->on('catalogues');
            $table->char('textsnam',60)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->char('namecust')->nullable($value = true);
            $table->char('textstre1',60)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->char('catidnamecity',30)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->char('codestte',30)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->char('codepstl',20)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->char('codectry',30)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->char('namectac',60)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->char('textphon1',30)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->char('textphon2',30)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
           // $table->char('codeterr',6)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->char('codecurn',3)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->char('codeterm',6)->nullable($value = true);
            $table->integer('ref_codeterm')->nullable($value = true);
            $table->char('codetaxgrp',12)->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable($value = true);
            $table->enum('ref_pst', ['Yes', 'No'])->nullable($value = true);
            $table->enum('ref_gst',['Yes', 'No'])->nullable($value = true);
            $table->char('idtaxregi1',20)->nullable($value = true);
            $table->char('codeslsp1',8)->nullable($value = true);
            $table->integer('ref_repid')->nullable($value = true);
            $table->float('price_multiplier',10,2)->nullable($value = true);
            $table->integer('csr')->nullable($value = true);
            $table->integer('catalog_id')->nullable($value = true);
            $table->integer('carrierid')->nullable($value = true);
            $table->char('codeterr',6)->nullable($value = true);
            $table->smallInteger('swhold')->nullable($value = true);
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
        Schema::dropIfExists('customers');
    }
}
